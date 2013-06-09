<?

class View extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("CategoryModel");
        $this->load->model("BookModel");
    }

    public function index()
    {
        $this->Category();
    }

    public function Category($categoryID = null, $page = 1)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        
        // key($slideBarList) First Element's Key
        $categoryID = $categoryID === null ? key($slideBarList) : $categoryID;
        $slideBarList[$categoryID]['Active'] = "active";

        $content = "CategoryView";
        $data["category"] = $this->CategoryModel->getCategoryName($categoryID);
        $data["cid"] = $categoryID;
        $data["page"] = $page;
        $data['list'] = $this->BookModel->searchByCategory($categoryID);
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>