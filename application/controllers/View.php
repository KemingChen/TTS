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
        $this->initPaginationConfig($config);
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();

        //key($slideBarList) First Element's Key
        //$categoryID = $categoryID === null ? key($slideBarList) : $categoryID;
        if ($categoryID != null)
        {
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

    public function SearchByName($name = "NoInput", $offset = 0)
    {
        $name = urldecode($name);
        $config['base_url'] = base_url("View/SearchByName/$name");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByNameSize($name);
        $this->initPaginationConfig($config);
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

    public function SearchByISBN($ISBN = "NoInput", $offset = 0)
    {
        $ISBN = urldecode($ISBN);
        $config['base_url'] = base_url("View/SearchByName/$ISBN");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByISBNSize($ISBN, $offset,
            20);
        $this->initPaginationConfig($config);
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

    public function SearchByAuthor($author = "NoInput", $offset = 0)
    {
        $author = urldecode($author);
        $config['base_url'] = base_url("View/SearchByAuthor/$author");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByAuthorSize($author,
            $offset, 20);
        $this->initPaginationConfig($config);
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

    public function SearchByBooksellers($booksellers = "NoInput", $offset = 0)
    {
        $booksellers = urldecode($booksellers);
        $config['base_url'] = base_url("View/SearchByBooksellers/$booksellers");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchByBooksellersSize($booksellers,
            $offset, 20);
        $this->initPaginationConfig($config);
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $booksellers \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByBooksellers($booksellers, $offset,
            20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function SearchByPublishDate($publishDate = "NoInput", $offset = 0)
    {
        $publishDate = urldecode($publishDate);
        $config['base_url'] = base_url("View/SearchByPublishDate/$publishDate");
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->CustomSearchModel->getSearchPublishedDateSize($publishDate,
            $offset, 20);
        $this->initPaginationConfig($config);
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "CategoryView";
        $data["category"] = "以\" $publishDate \"搜尋...";
        $data["list"] = $this->CustomSearchModel->searchByPublishedDate($publishDate, $offset,
            20);
        $data["pagination"] = $this->pagination->create_links();
        $data['limit'] = 20;
        $data['offset'] = $offset;
        $data['cid'] = null;
        $this->template->loadView("Category", $slideBarList, $content, $data);
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
}

?>