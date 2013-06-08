<?php

class CustomSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CustomSearchModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function searchByAuthor($authorName)
    {
	    $authorName = urldecode($authorName);
        $data["records"] = $this->CustomSearchModel->searchByAuthor($authorName);
        $this->load->view('CustomSearch/browse', $data);
    }
    
    public function searchByName($name)
    {
        $name = urldecode($name);
        $data["records"] = $this->CustomSearchModel->searchByName($name);
        $this->load->view('CustomSearch/browse', $data);
    }
    
    public function searchByBooksellers($sellerName)
    {
        $sellerName = urldecode($sellerName);
        $data["records"] = $this->CustomSearchModel->searchByBooksellers($sellerName);
        $this->load->view('CustomSearch/browse', $data);
    }
    
    public function searchByPublishedDate($publishedDate)
    {
        $data["records"] = $this->CustomSearchModel->searchByPublishedDate($publishedDate);
        $this->load->view('CustomSearch/browse', $data);
    }  
    
    public function searchByCategory($category)
    {
        $category = urldecode($category);
        $data["records"] = $this->CustomSearchModel->searchByCategory($category);
        $this->load->view('CustomSearch/browse', $data);
    }
    
    public function searchByISBN($isbn)
    {
        $data["records"] = $this->CustomSearchModel->searchByISBN($isbn);
        $this->load->view('CustomSearch/browse', $data);
    }
}

?>