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

        //去DB拿資料
        $user = array("email" => "believe");
        //End

        $this->authority->login($user);

        if ($this->authority->isLogin())
        {
            header("Location: " . base_url());
        }
        else
        {

        }
    }
}

?>