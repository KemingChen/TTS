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
        $slideBarList = $this->MenuModel->getCategoryList();
        $first_key = key($slideBarList); // First Element's Key
        $slideBarList[$first_key]['Active'] = "active";
        
        $content = "CategoryView";
        $data["category"] = $this->CategoryModel->getCategoryName($first_key);
        $data["cid"] = $first_key;
        $data['list'] = $this->BookModel->searchByCategory($first_key);

        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function Category($categoryID, $page=1)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $slideBarList[$categoryID]['Active'] = "active";

        $content = "CategoryView";
        $data["category"] = $this->CategoryModel->getCategoryName($categoryID);
        $data["cid"] = $categoryID;
        $data['list'] = $this->BookModel->searchByCategory($categoryID);
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>