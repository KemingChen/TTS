<?

class Template extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function tIndex($page, $data = array(), $return = false)
    {
        $this->load->view('include/header');
        $this->load->view($page, $data, $return);
        $this->load->view('include/footer');
    }
}

?>