<?

class Func extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
        $this->load->model("template");
        $this->load->model("MenuModel");
    }

    public function login()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("passwd");

        $isLogin = $this->authority->login($email, $password);
        $isLogin ? $this->header() : $this->header("Func/ErrorLogin");
    }

    public function logout()
    {
        $this->authority->logout();
        $this->header();
    }

    public function addConcernBook()
    {

    }

    private function header($url = "")
    {
        $this->load->helper('url');
        header("Location: " . base_url() . $url);
    }

    public function ErrorLogin()
    {
        $content = "Error";
        $data['ErrorID'] = "NoThisAccount";
        $slideBarList = $this->MenuModel->getAnnouncementList();
        $this->template->loadView("Announcement", $slideBarList, $content, $data);
    }
}

?>