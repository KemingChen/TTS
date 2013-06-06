<?

class Template extends CI_Model
{
    private $header;
    private $sliderBar;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        $this->initHeader();
        $this->initSliderBar();
    }

    // using Category Slider Bar
    public function uCSliderBar($activeID, $pageName, $data = array())
    {
        $this->SliderBar("Category", $activeID, $pageName, $data);
    }

    // using Member Slider Bar
    public function uMSliderBar($activeID, $pageName, $data = array())
    {
        $this->SliderBar("Member", $activeID, $pageName, $data);
    }

    private function SliderBar($SBName, $activeID, $pageName, $data)
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;
        $info["menu"] = $this->setActive($activeID, $this->sliderBar[$SBName]);

        $this->load->view('include/Header', $this->getHeaderInfo($SBName));
        $this->load->view("include/SliderBar", $info, $return);
        $this->load->view('include/Footer');
    }

    private function getHeaderInfo($SBName)
    {
        $info = array();
        $info["isLogin"] = true;
        $info["header"] = $this->setActive($SBName, $this->header);
        return $info;
    }

    private function initHeader()
    {
        $header = array();
        array_push($header, array("ID" => "Category", "Tag" => "瀏覽書籍"));
        array_push($header, array("ID" => "Member", "Tag" => "會員專區"));
        $this->saveInfo($this->header, $header);
    }

    private function initSliderBar()
    {
        $cSBar = array();
        array_push($cSBar, array("ID" => "C0", "Tag" => "商業理財"));
        array_push($cSBar, array("ID" => "C1", "Tag" => "文學小說"));
        array_push($cSBar, array("ID" => "C2", "Tag" => "藝術設計"));
        $this->saveInfo($this->sliderBar["Category"], $cSBar, "Category/");

        $mSBar = array();
        array_push($mSBar, array("ID" => "Member", "Tag" => "會員資料"));
        array_push($mSBar, array("ID" => "Record", "Tag" => "交易紀錄"));
        array_push($mSBar, array("ID" => "ShopCar", "Tag" => "購物車"));
        array_push($mSBar, array("ID" => "RePassword", "Tag" => "修改密碼"));
        $this->saveInfo($this->sliderBar["Member"], $mSBar);
    }

    private function saveInfo(&$list, $array, $baseUrl = "")
    {
        for ($i = 0; $i < count($array); $i++)
        {
            $array[$i]["Url"] = $baseUrl . $array[$i]["ID"];
        }
        $list = $array;
    }
    
    private function setActive($activeID, &$data)
    {
        for ($i = 0; $i < count($data); $i++)
        {
            $data[$i]["Active"] = $data[$i]["ID"] == $activeID ? "active" : "";
        }
        return $data;
    }
}

?>