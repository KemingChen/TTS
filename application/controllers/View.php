<?

class View extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("CategoryModel");
        $this->load->model("BrowseModel");
        $this->load->model("BookModel");
        $this->load->library('pagination');
    }

    public function index()
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $this->Category(key($slideBarList));
        
    }

    public function Category($categoryID = null, $offset = 0)
    {
        $config['base_url'] = base_url("View/Category/$categoryID");
        $config['uri_segment'] = 4; 
        $config['total_rows'] = $this->BookModel->getCategoryAmount($categoryID);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();

        //key($slideBarList) First Element's Key
        $categoryID = $categoryID === null ? key($slideBarList) : $categoryID;
        $slideBarList[$categoryID]['Active'] = "active";


        $content = "CategoryView";
        $data["cid"] = $categoryID;
        $data["category"] = $this->CategoryModel->getCategoryName($categoryID);
        $array = $this->BrowseModel->GetBookByCategory($categoryID, $offset, 20);
        $data["list"] = $array["books"];
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function SearchByName($name)
    {

    }

    public function SearchByAuthor($author)
    {

    }

    public function SearchByBookSellers($bookSellers)
    {

    }

    public function SearchByPublishDate($publishDate)
    {

    }

    public function SearchByISBN($ISBN)
    {

    }
}

?>