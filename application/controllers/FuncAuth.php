<?

class FuncAuth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
        $this->load->helper('url');
    }

    public function logout()
    {
        $this->authority->logout();
        header("Location: " . base_url());
    }
}

?>