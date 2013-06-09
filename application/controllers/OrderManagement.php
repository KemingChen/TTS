<?
class OrderManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
    }

    public function index($page = 1)
    {
        $slideBarList = $this->MenuModel->getManagerList();

        $slideBarList["OrderManagement"]['Active'] = "active";

        $content = "OrderManagementView";
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementList();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>