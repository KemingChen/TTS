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

    public function page($offset = 0)
    {
        $config['base_url'] = base_url('Stock/page');
        //$config['total_rows'] = $this->BookModel->getTotalAmount();
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
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["Stock"]['Active'] = "active";
        $content = "StockView";
        $data["list"] = array();
        //$data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }

    public function book($bookName = "", $offset = 0)
    {
        $bookName = urldecode($bookName);
        $config['base_url'] = base_url("Stock/book/$bookName");
        $config['total_rows'] = $this->BookModel->getAmountByBookName($bookName);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['url_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["Stock"]['Active'] = "active";
        $content = "StockView";
        $data["list"] = $this->BookModel->getBookListByBookName($bookName, 20, $offset);
        $data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }

    public function addStockRecord($bid, $cost, $amount)
    {
        $this->StockModel->addStockRecord($bid, $cost, $amount);
        echo $bid;
    }


    public function browseBooksStock($offset = 0, $limit = 10)
    {
        $data["records"] = $this->StockModel->browseBooksStock();
        $this->load->view('Stock/browseBooksStock', $data);
        $data = $this->StockModel->browseBooksStock($limit, $offset);
        $this->load->view('Stock/browseBooksStock', $data);
    }

    public function browseStockRecord($offset = 0, $limit = 10)
    {
        $data = $this->StockModel->browseStockRecord($limit, $offset);
        $this->load->view('Stock/browseStockRecord', $data);
    }

    public function getBookInfo($isbns = null)
    {
        if ($isbns == null)
            return;
        $this->load->model("CustomSearchModel");
        $data["lists"] = array();
        $data["errors"] = array();
        $tempArray = array();
        $isbns = urldecode($isbns);
        $isbns = str_replace(" ", "", $isbns);
        foreach (explode(",", $isbns) as $isbn)
        {
            if ($isbn != "" && !in_array($isbn, $tempArray))
            {
                array_push($tempArray, $isbn);
                $temp = $this->CustomSearchModel->searchByISBN($isbn);
                if (count($temp) > 0)
                {
                    array_push($data["lists"], $temp);
                }
                else
                {
                    array_push($data["errors"], $isbn);
                }
            }
        }
        $this->load->view('AjaxView/StockItem', $data);
    }
}

?>