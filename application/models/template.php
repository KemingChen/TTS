<?

class Template extends CI_Model
{
    private $cSliderBar;
    private $mSliderBar;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function uCSliderBar($pageName, $data = array()) // using Category Slider Bar
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;

        $this->load->view('include/Header', $this->getHeaderInfo());
        $this->load->view("include/CategorySliderBar", $info, $return);
        $this->load->view('include/Footer');
    }

    public function uMSliderBar($pageName, $data = array()) // using Member Slider Bar
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;

        $this->load->view('include/Header', $this->getHeaderInfo());
        $this->load->view("include/MemberSliderBar", $info, $return);
        $this->load->view('include/Footer');
    }

    private function setSliderBarInfo($activeID, &$data)
    {
        for ($i = 0; $i < count($data); $i++)
        {
            $data[$i]["Active"] = $data[$i]["ID"] == $activeID ? "active" : "";
        }
    }

    private function getHeaderInfo()
    {
        $info = array();
        $info["isLogin"] = true;
        return $info;
    }
    
    private function initSliderBar()
    {
        $cSBar = $this->cSliderBar;
        array_push($cSBar, array("ID" => "C0", "Tag" => "商業理財"));
        array_push($cSBar, array("ID" => "C1", "Tag" => "文學小說"));
        array_push($cSBar, array("ID" => "C2", "Tag" => "藝術設計"));
        
        $mSBar = $this->mSliderBar;
        array_push($cSBar, array("ID" => "", "Tag" => "會員資料"));
        array_push($cSBar, array("ID" => "", "Tag" => "交易紀錄"));
        array_push($cSBar, array("ID" => "", "Tag" => "購物車"));
        array_push($cSBar, array("ID" => "", "Tag" => "修改密碼"));
    }
}

?>