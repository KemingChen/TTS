<?
class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->model("BrowseModel");
        $this->load->model("CategoryModel");
    }

    public function index()
    {
        $data = $this->getData();
        $this->template->loadView("Announcement", array(), "AnnoucementView", $data);
    }
    
    public function getData(){
        $temp = $this->BrowseModel->GetLatestBook(0, 5);
        $data["latestPublishList"] = $temp['books'];
        
        
        $temp = $this->BrowseModel->GetHotRankingBook(0, 5);
        $data["hotRankingList"] = $temp['books'];
        
        
        $temp = $this->BrowseModel->GetMostConcernedBook(0, 5);
        $data["mostConcernedList"] = $temp['books'];
        
        $categoryList = $this->CategoryModel->getCategoryList();
        $categoryIndex = rand(0, count($categoryList)-1);
        $categoryID = $categoryList[$categoryIndex]->cid;
        $categoryName = $categoryList[$categoryIndex]->name;
        
        $data['categoryName'] = $categoryName;
        
        $temp = $this->BrowseModel->GetBookByCategory($categoryID, 0, 5);
        $data["categoryBookList"] = $temp['books'];
        
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementList();
        return $data;
    }
    
    public function ByLatestPublish($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetLatestBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByHotRanking($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetHotRankingBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByMostConcerned($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetMostConcernedBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByCategory($categoryID, $offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetBookByCategory($categoryID, $offset, $limit);
        $this->load->view("browse/category", $data);
    }
}

?>