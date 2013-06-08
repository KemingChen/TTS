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
    
    public function ByCategory($categoryID, $offset=0, $limit=10)
    {
        $data = $this->BrowseModel->GetBookByCategory($categoryID, $offset, $limit);
        $this->template->view("", "", "browse/category", $data);
    }
    
    public function ByLatestPublish($offset=0, $limit=10)
    {
        $data = $this->BrowseModel->GetLatestBook($offset, $limit);
        $this->template->view("", "", "browse/category", $data);
    }
}
?>