<?

class ForgotPassword extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AccountModel");
        $this->load->library('form_validation');
        $this->load->model("MemberModel");
    }

    public function index()
    {
        $slideBarList = $this->MenuModel->getNonMemberList();
        $slideBarList["ForgotPassword"]['Active'] = "active";

        $content = "ForgotPasswordView";
        $data = array();
        $email = $this->input->post("email");
        $this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            if ($this->AccountModel->isExist($email)) {
                $this->MemberModel->forgetPassword($email);
                $data["message"] = "密碼已寄出至指定的信箱。";
            } else {
                $data["message"] = "此帳號不存在。";
            }
        }
        
        $this->template->loadView("NewMember", $slideBarList, $content, $data);
    }
}

?>