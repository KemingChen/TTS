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
        $this->load->model("BookModel");
        $this->load->library("pagination");
    }

    public function index($offset = 0)
    {
        $this->page($offset);
    }
    
    public function page($offset){
        
        $config['base_url'] = base_url('Stock/page');
        $config['total_rows'] = $this->BookModel->getTotalAmount();//$data["count"];
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["Stock"]['Active'] = "active";
        $content = "StockView";
        $data["list"] = $this->BookModel->getAllBooks($offset, 20);//$result["books"];
        $data["pagination"] = $this->pagination->create_links();
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