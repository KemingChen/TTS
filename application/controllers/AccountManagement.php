<?
class AccountManagement extends CI_Controller
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
        $slideBarList = $this->MenuModel->getAdministratorList();

        $slideBarList["AccountManagement"]['Active'] = "active";

        $content = "AccountManagementView";
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementList();
        $this->template->loadView("Administrator", $slideBarList, $content, $data);
    }
}

?>