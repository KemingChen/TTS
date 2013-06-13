<?

class ViewEcoupon extends CI_Controller
{
    private $param;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("authority");
        $this->authority->checkAuth(array("", "manager"));
    }

    public function index()
    {
        $this->Me("Ecoupon");
    }

    public function Me($action, $param = null)
    {
        $this->param = $param;
        $this->view($action);
    }

    public function doEcoupon(&$content)
    {
        $content = "EcouponView";
        return array();
    }
    
    public function sendEcoupon($totalnum, $price, $startTime, $endTime)
    {
        $this->load->model("accountModel");
        $accountData = $this->accountModel->getValidMemberListForEcoupon();
        $accountnum = $accountData == null ? 0 : count($accountData);
        $luckys = $this->getLuckys($accountnum, $totalnum);
        set_time_limit(ini_get('max_execution_time'));
        foreach ($luckys as $lucky)
        {
            $this->sendEcouponMail($accountData[$lucky]->mid, $price, $startTime, $endTime);
        }
    }

    private function sendEcouponMail($mid, $price, $startTime, $endTime)
    {
        $this->load->model("gmailModel");
        $this->load->model("accountModel");
        $this->load->model("EcouponModel");

        $account = $this->accountModel->getMemberInfoForEcoupon($mid);
        $name = $account->name;
        $recipient = $account->email;

        $coupon = $this->EcouponModel->generateCouponCode();
        $this->EcouponModel->insertECoupon($coupon, $startTime, $endTime, $price);

        $subject = "送您 台客書店 Ecoupon";

        $message = "親愛的 $name \n";
        $message .= "恭喜你抽到我們的 $price 元的 Eoupon\n";
        $message .= "您的 Eoupon 號碼為 $coupon \n";
        $message .= "使用期限 $startTime ~ $endTime \n";
        $message .= "盡快去使用哦^__^";

        $this->gmailModel->sendMail($recipient, $subject, $message);
        return $recipient;
    }

    private function getLuckys($accountnum, $totalnum)
    {
        srand($this->make_seed());
        $luckys = array();
        for ($i = 0; $i < $totalnum && $i < $accountnum; )
        {
            $draw = rand(0, $accountnum - 1);
            if (!in_array($draw, $luckys))
            {
                array_push($luckys, $draw);
                $i++;
            }
        }
        return $luckys;
    }

    private function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float)$sec + ((float)$usec * 100000);
    }

    private function view($action)
    {
        $slideBarList = $this->MenuModel->getManagerList();
        $action = $action === null ? key($slideBarList) : $action;
        $data = $this->{"do$action"}($content);
        $slideBarList[$action]['Active'] = "active";
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>