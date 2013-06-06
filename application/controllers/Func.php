<?

class Func extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
    }

    public function login()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("passwd");
        
        $isLogin = $this->authority->login($email, $password);
        $isLogin ? $this->header() : $this->header("Nav/Error/NoThisAccount"); 
    }
    
    public function logout()
    {
        $this->authority->logout();
        $this->header();
    }
    
    private function header($url = "")
    {
        $this->load->helper('url');
        header("Location: " . base_url() . $url);
    }
}

?>