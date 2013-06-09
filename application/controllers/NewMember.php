<?
class NewMember extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AccountModel");
        $this->load->library('form_validation');
        $this->load->model("BrowseModel");
    }

    public function index()
    {
        $slideBarList = $this->MenuModel->getNonMemberList();
        $slideBarList["NewMember"]['Active'] = "active";


        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('authority', 'authority', 'required');
        $this->form_validation->set_rules('available', 'available', 'required');
        $this->form_validation->set_rules('phoneNumber', 'phoneNumber', 'required');
        if ($this->form_validation->run() === false) {
            $content = "NewMemberView";
            $this->template->loadView("NewMember", $slideBarList, $content, array());
        } else {
            $email = $this->input->post('email');
            if ($this->AccountModel->isExist($email)) {
                $content = "NewMemberView";
                $this->template->loadView("NewMember", $slideBarList, $content, array("error" =>
                    "帳號已重複"));
            } else {
                $this->AccountModel->createAccount();
                $email = $this->input->post("email");
                $password = $this->input->post("password");
                $this->authority->login($email, $password);
                $this->loadView();
            }
        }
    }
    public function browseAccountList()
    {
        $data['account'] = $this->AccountModel->browseAccountList();
        if ($data['account']->num_rows() > 0) {
            $this->load->view('Account/BrowseAccountList', $data);
        } else {
            show_error("no data");
        }
    }
    
    public function loadView(){
        $slideBarList = $this->MenuModel->getCategoryList();
        // key($slideBarList) First Element's Key
        $categoryID = key($slideBarList);
        $slideBarList[$categoryID]['Active'] = "active";

        $limit = 8;
        $offset = 0;
        
        $content = "CategoryView";
        $data["category"] = $this->CategoryModel->getCategoryName($categoryID);
        $data["cid"] = $categoryID;
        $data["page"] = 1;
        $array = $this->BrowseModel->GetBookByCategory($categoryID, $offset, $limit);
        $data["list"] = $array["books"];
        $data["pages"] = ceil($array["total_num_rows"] / $limit);
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>
