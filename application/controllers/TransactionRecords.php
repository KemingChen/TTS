<?
class TransactionRecords extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("TransactionModel");
        $this->load->model("MenuModel");
    }

    public function index($offset = 0)
    {
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["TransactionRecords"]['Active'] = "active";

        $content = "TransactionRecordsView";
        $data["list"] = $this->TransactionModel->browseTransactionRecords();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>