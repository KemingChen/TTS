<?

class ViewMember extends CI_Controller
{
    private $param;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
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

        $info["list"] = array();
        array_push($info["list"], array("ISBN" => "9789570410976", "Name" =>
            "初學者的料理教科書：2500張步驟圖解，新手必備史上最簡單！看這本，保證不失敗！", "Quantity" => "2", "Price" => "480"));
        array_push($info["list"], array("ISBN" => "9572884301", "Name" =>
            "飼養烏龜必知的68項小常識", "Quantity" => "1", "Price" => "220"));
        array_push($info["list"], array("ISBN" => "9789862282359", "Name" =>
            "輕輕鬆鬆養烏龜：68個飼養小常識", "Quantity" => "2", "Price" => "440"));
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