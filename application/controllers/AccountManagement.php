<?
class AccountManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->model("AccountModel");
        $this->load->library("pagination");
    }

    public function index()
    {
        $this->page(0);
    }

    public function page($offset = 0)
    {
        $slideBarList = $this->MenuModel->getAdministratorList();
        $slideBarList["AccountManagement"]['Active'] = "active";

        $config['base_url'] = base_url("AccountManagement/page");
        $config['total_rows'] = $this->AccountModel->getAccountAmountByEmail("");
        $this->initPaginationConfig($config);
        $this->pagination->initialize($config);


        $content = "AccountManagementView";
        $data["list"] = $this->AccountModel->getAccountListByEmail("", 20, $offset);
        $data["pagination"] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $this->template->loadView("Administrator", $slideBarList, $content, $data);
    }

    public function email($email, $offset = 0)
    {
        $slideBarList = $this->MenuModel->getAdministratorList();
        $slideBarList["AccountManagement"]['Active'] = "active";

        $config['base_url'] = base_url("AccountManagement/page/$email");
        $config['total_rows'] = $this->AccountModel->getAccountAmountByEmail("$email");
        $config['url_segment'] = 4;
        
        $this->initPaginationConfig($config);
        $this->pagination->initialize($config);


        $content = "AccountManagementView";
        $data["list"] = $this->AccountModel->getAccountListByEmail("$email", 20, $offset);
        $data["pagination"] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $this->template->loadView("Administrator", $slideBarList, $content, $data);
    }

    private function initPaginationConfig(&$config)
    {
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['num_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] =
            $config['first_tag_open'] = $config['last_tag_open'] = '<li>';
        $config['num_tag_close'] = $config['prev_tag_close'] = $config['next_tag_close'] =
            $config['first_tag_close'] = $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li = class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a>";
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
    }
}

?>