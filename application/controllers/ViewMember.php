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
        $selectNum = 10;
        $offset = $selectNum * ($page - 1);

        $array = $this->ConcernModel->queryConcernBooks($mid, $offset, $selectNum);
        $info["page"] = $page;
        $info["pages"] = $array["total_NumRows"] / $selectNum;
        $info["list"] = $array["books"]->result();
        return $info;
    }

    private function doShopCar(&$content)
    {
        $content = "ShopCarView";
        $mid = $this->authority->getMemberID();

        $data = $this->ShoppingCartModel->getWholeShoppingCart($mid, 10, 0);
        $info["list"] = $data['cart']->result();
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