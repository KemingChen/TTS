<?

class Func extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
        $this->load->helper('url');
    }

    public function login()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("passwd");
        
        $isLogin = $this->authority->login($email, $password);
        $isLogin ? $this->header() : $this->header("Nav/Error/NoThisAccount"); 
    }
    
    private function header($url = "")
    {
        header("Location: " . base_url() . $url);
    }
}

?>