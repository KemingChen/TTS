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
        $this->load->model("CustomSearchModel");
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
        //$categoryID = $categoryID === null ? key($slideBarList) : $categoryID;
        if ($categoryID != null) {
            $slideBarList[$categoryID]['Active'] = "active";
        }


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

    public function SearchByName($name, $offset=0)
    {
        $name = urldecode($name);
        $config['base_url'] = base_url("View/SearchByName/$name");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByNameSize($name);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $name \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByName($name, $offset, 20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
    
    public function SearchByISBN($ISBN, $offset=0)
    {
        $ISBN = urldecode($ISBN);
        $config['base_url'] = base_url("View/SearchByName/$ISBN");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByISBNSize($ISBN, $offset, 20);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $ISBN \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByISBN($ISBN, $offset, 20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function SearchByAuthor($author, $offset=0)
    {
        $author = urldecode($author);
        $config['base_url'] = base_url("View/SearchByAuthor/$author");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByAuthorSize($author, $offset, 20);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $author \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByAuthor($author, $offset, 20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function SearchByBooksellers($booksellers, $offset=0)
    {
        $booksellers = urldecode($booksellers);
        $config['base_url'] = base_url("View/SearchByBooksellers/$booksellers");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByBooksellersSize($booksellers, $offset, 20);
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $booksellers \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByBooksellers($booksellers, $offset, 20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function SearchByPublishDate($publishDate, $offset=0)
    {

    }
}

?>