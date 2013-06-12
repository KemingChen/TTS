<?
class ViewMember extends CI_Controller
{
    private $param;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("ShoppingCartModel");
        $this->load->model("MemberModel");
        $this->load->helper(array('form', 'url', "date"));
        $this->load->library('form_validation');
        $this->load->model("TransactionModel");
    }

    public function index()
    {
        $this->Me(null);
    }

    public function Me($action, $param = null)
    {
        $this->param = $param;
        $this->view($action);
    }

    public function updateInfo()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('zipCode', 'zipcode', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        if ($this->form_validation->run() == false) {
            $this->view("Info");
        } else {
            $mid = $this->authority->getMemberID();
            $name = $this->input->post("name");
            $birthday = $this->input->post("birthday");
            $zipCode = $this->input->post("zipCode");
            $address = $this->input->post("address");
            $this->MemberModel->updateInfo($mid, $name, $birthday, $zipCode, $address);
            $this->authority->reload();
            $this->Me("Info");
        }
    }

    private function doInfo(&$content)
    {
        $this->load->model("authority");
        $content = "MemberView";

        $info["email"] = $this->authority->getEmail();
        $info["name"] = $this->authority->getName();
        $info["birthDate"] = $this->authority->getBirthDate();
        $info["zipCode"] = $this->authority->getZipCode();
        $info["address"] = $this->authority->getAddress();
        return $info;
    }

    private function doTransaction(&$content)
    {
        $this->load->model("TransactionModel");
        $content = "TransactionView";
        $mid = $this->authority->getMemberID();
        $info['list'] = $this->TransactionModel->browseTransactionRecordsByMid($mid);
        return $info;
    }
    
    public function getTransactionDetailView($oid){
        $data["list"] = $this->TransactionModel->getOrderItemDataByOid($oid);
        $this->load->view("TransactionDetailView", $data);
    }

    private function doConcern(&$content)
    {
        $this->load->model("authority");
        $this->load->model("ConcernModel");
        $content = "ConcernView";

        $page = $this->param === null ? 1 : $this->param;
        $mid = $this->authority->getMemberID();
        $selectNum = 5;
        $offset = $selectNum * ($page - 1);

        $info = $this->ConcernModel->queryConcernBooks($mid, $offset, $selectNum);
        $info["page"] = $page;
        $info["pages"] = ceil($info["total_NumRows"] / $selectNum);
        return $info;
    }

    private function doShopCar(&$content)
    {
        $content = "ShopCarView";

        $mid = $this->authority->getMemberID();
        $info = $data = $this->ShoppingCartModel->getWholeShoppingCart($mid);
        $info['mid'] = $mid;
        return $info;
    }

    public function order($couponCode = "")
    {
        $mid = $this->authority->getMemberID();


        $originalShoppingCartData = $this->TransactionModel->getShoppingCartDataByMid($mid);
        $stockEnough = false;
        $stockEnough = $this->TransactionModel->IsAllStockEnough($mid);
        if ($stockEnough) {
            $datestring = "%Y-%m-%d";
            $now = now();
            $now = mdate($datestring, $now);
            $data = array('mid' => $mid, 'orderTime' => $now, 'state' => 'processing');
            $this->TransactionModel->order($mid, $data, $couponCode);
            //loadview
            $slideBarList = $this->MenuModel->getMemberList();
            $data = $this->doShopCar($content);
            $slideBarList["ShopCar"]['Active'] = "active";
            $this->template->loadView("Member", $slideBarList, $content, $data);
        } else {
            //�N�ʪ�����T�אּ�w�s�ƶq
            //���o�w�s���
            $ShoppingCartData['restQuantityList'] = $this->TransactionModel->
                getNotEnoughBookStockQuantity($originalShoppingCartData->result());
            //�٭�w�s���
            $this->ShoppingCartModel->clearShoppingCart($mid);
            foreach ($originalShoppingCartData->result() as $row) {
                $this->ShoppingCartModel->addShoppingCart($mid, $row->bid, $row->quantity);
            }
            //loadview
            $slideBarList = $this->MenuModel->getMemberList();
            $this->template->loadView("Member", $slideBarList, "ShopCarViewNotEnough", $ShoppingCartData);
        }
    }

    public function revisePassword($oldPassword, $newPassword)
    {
        $password = $this->authority->getPassword();
        //echo "password=$password";
        if ($oldPassword == $password) {
            $this->MemberModel->revisePassword($newPassword);
            $this->authority->reload($newPassword);
            echo "OK";
        } else {
            echo "ERROR";
        }
    }

    private function doPassword(&$content)
    {
        $content = "RevisePasswordView";
        return array();
    }

    private function view($action)
    {
        $slideBarList = $this->MenuModel->getMemberList();
        $action = $action === null ? key($slideBarList) : $action;
        $data = $this->{"do$action"}($content);
        $slideBarList[$action]['Active'] = "active";
        $this->template->loadView("Member", $slideBarList, $content, $data);
    }
}
?>