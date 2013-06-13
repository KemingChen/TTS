<?
class ViewReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("ReportModel");
        $this->load->library('pagination');
    }

    public function index($offset = 0)
    {
        $slideBarList = $this->MenuModel->getManagerList();

        $slideBarList["ViewReport"]['Active'] = "active";

        $content = "ReportView";
        $result = $this->ReportModel->bookSellReport();
        $data["list"] = $result["report"];
        $data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>