<?
class OnShelf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->library('pagination');
        $this->load->model("BookModel");
    }

    public function index($page = 1)
    {
        $this->page($page);
    }

    public function page($offset)
    {
        $config['base_url'] = base_url('OnShelf/page');
        $config['total_rows'] = $this->BookModel->getOffShelfAmount();
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["OnShelf"]['Active'] = "active";
        $content = "OnShelfView";
        $result = $this->BookModel->selectBooks_by_OnShelfAttr(FALSE, $offset, 20);
        $data["list"] = $result["books"];
        $data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
    }
}

?>