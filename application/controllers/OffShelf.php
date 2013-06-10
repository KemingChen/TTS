<?
class OffShelf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->library('pagination');
        $this->load->model("BookModel");
    }

    public function index($offset = 0)
    {
        $this->page($offset);
    }
    
    public function off($bid){
        $this->BookModel->updateOnShelf($bid, FALSE);
        $this->page();
    }

    public function page($offset = 0)
    {
        $config['base_url'] = base_url('OffShelf/page');
        $config['total_rows'] = $this->BookModel->getOnShelfAmount();
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["OffShelf"]['Active'] = "active";
        $content = "OffShelfView";
        $result = $this->BookModel->selectBooks_by_OnShelfAttr(TRUE, $offset, 20);
        $data["list"] = $result["books"];
        $data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>