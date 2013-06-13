<?php
class Browse extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BrowseModel");
        $this->load->model("template");
    }
    
    public function index()
    {
        $this->listAll();
    }
    
    public function ByCategory($categoryID, $offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetBookByCategory($categoryID, $offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByLatestPublish($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetLatestBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByMostConcerned($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetMostConcernedBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
    
    public function ByHotRanking($offset=0, $limit=5)
    {
        $data = $this->BrowseModel->GetHotRankingBook($offset, $limit);
        $this->load->view("browse/category", $data);
    }
}
?>