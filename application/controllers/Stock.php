<?
class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->model("StockModel");
    }

    public function index($offset = 0)
    {
        $this->page($offset);
    }
    
    public function page($offset){
        $slideBarList = $this->MenuModel->getManagerList();

        $slideBarList["Stock"]['Active'] = "active";

        $content = "StockView";
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementList();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
    

    public function browseBooksStock($offset=0,$limit=10)
    {
        $data["records"] = $this->StockModel->browseBooksStock();
        $this->load->view('Stock/browseBooksStock', $data);
        $data = $this->StockModel->browseBooksStock($limit,$offset);
        $this->load->view('Stock/browseBooksStock', $data);
    }

    
    public function browseStockRecord($offset=0,$limit=10)
    {
        $data = $this->StockModel->browseStockRecord($limit,$offset);
        $this->load->view('Stock/browseStockRecord', $data);
    }
    
    public function addStockRecord($bid, $price, $amount)
    {
        $this->StockModel->addStockRecord($bid, $price, $amount);
        echo 'OK';
    }    
}

?>