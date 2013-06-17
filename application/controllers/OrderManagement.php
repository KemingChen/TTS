<?
class OrderManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("TransactionModel");
        $this->load->model("MenuModel");
        $this->load->library("pagination");
    }

    public function index($offset = 0)
    {
        $this->page($offset);
    }

    public function page($offset = 0)
    {
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["OrderManagement"]['Active'] = "active";
        $this->initPaginationConfig($config);
        $config['base_url'] = base_url("OrderManagement/page/");
        $config['total_rows'] = $this->TransactionModel->getNotArrivedOrderAmount();
        $this->pagination->initialize($config);

        $content = "OrderManagementView";
        $data["list"] = $this->TransactionModel->getNotArrivedOrderLimit(20, $offset);
        $data['pagination'] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
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
    
    public function modifyOrderSummaryState($oid, $state){
        $this->TransactionModel->manageOrderState($oid, $state);
        echo "OK";
    }
}

?>