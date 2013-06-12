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
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
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
        } else {
            $mid = $this->authority->getMemberID();
            $name = $this->input->post("name");
            $birthday = $this->input->post("birthday");
            $zipCode = $this->input->post("zipCode");
            $address = $this->input->post("address");
            $this->MemberModel->updateInfo($mid, $name, $birthday, $zipCode, $address);
            $this->authority->reload();
        }
        $this->view("Info");
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

        $info['list'] = $this->TransactionModel->browseTransactionRecords();
        return $info;
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

        $array = $this->ConcernModel->queryConcernBooks($mid, $offset, $selectNum);
        $info["page"] = $page;
        $info["pages"] = ceil($array["total_NumRows"] / $selectNum);
        $info["list"] = $array["books"]->result();
        return $info;
    }

    private function doShopCar(&$content)
    {
        $content = "ShopCarView";

        $mid = $this->authority->getMemberID();
        $info = $data = $this->ShoppingCartModel->getWholeShoppingCart($mid);
        return $info;
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