<?

class Template extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function uCSliderBar($pageName, $data = array())// using Category Slider Bar
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;
        
        $this->load->view('include/Header', $this->getHeaderInfo());
        $this->load->view("include/CategorySliderBar", $info, $return);
        $this->load->view('include/Footer');
    }
    
    private function getHeaderInfo()
    {
        $info = array();
        $info["isLogin"] = false;
        return $info;
    }
}

?>