<?
class AnnouncementManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->library('pagination');
    }

    public function index($offset=0)
    {
        $this->page($offset);
    }
    
    public function page($offset=0){
        $config['base_url'] = base_url('AnnouncementManagement/page');
        $config['total_rows'] = $this->AnnouncementModel->getAnnouncementSize();
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);
        
        
        $slideBarList = $this->MenuModel->getManagerList();

        $slideBarList["AnnouncementManagement"]['Active'] = "active";

        $content = "AnnouncementManagementView";
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementListLimit($offset, 5);
        $data["offset"] = $offset;
        $data['pagination'] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
    
    public function remove(){
        
    }
}

?>