<?
class NewMember extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $slideBarList = $this->MenuModel->getNonMemberList();
        $slideBarList["NewMember"]['Active'] = "active";

        $content = "NewMemberView";

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('authority', 'authority', 'required');
        $this->form_validation->set_rules('available', 'available', 'required');
        $this->form_validation->set_rules('phoneNumber', 'phoneNumber', 'required');
        if ($this->form_validation->run() === false) {
            $this->template->loadView("NewMember", $slideBarList, $content, array());
        } else {
            $this->AccountModel->createAccount();
            $this->browseAccountList();
        }
    }
}

?>