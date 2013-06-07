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
    
    public function searchByAuthor()
    {
        $this->form_validation->set_rules('authorName', 'authorName', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("CustomSearch/author", array());
    	}
    	else
    	{
            $data["records"] = $this->CustomSearchModel->searchByAuthor();
            $this->load->view('CustomSearch/browse', $data);
    	}
    }
    
    public function searchByName()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("CustomSearch/name", array());
    	}
    	else
    	{
            $data["records"] = $this->CustomSearchModel->searchByName();
            $this->load->view('CustomSearch/browse', $data);
    	}
    }
    
    public function searchByBooksellers()
    {
        $this->form_validation->set_rules('sellerName', 'sellerName', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("CustomSearch/bookSeller", array());
    	}
    	else
    	{
            $data["records"] = $this->CustomSearchModel->searchByBooksellers();
            $this->load->view('CustomSearch/browse', $data);
    	}
    }
    
    public function searchByPublishedDate()
    {
        $this->form_validation->set_rules('publishedDate', 'publishedDate', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("CustomSearch/publishedDate", array());
    	}
    	else
    	{
            $data["records"] = $this->CustomSearchModel->searchByPublishedDate();
            $this->load->view('CustomSearch/browse', $data);
    	}
    }  
    
    public function searchByCategory()
    {
        $this->form_validation->set_rules('category', 'category', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("CustomSearch/category", array());
    	}
    	else
    	{
            $data["records"] = $this->CustomSearchModel->searchByCategory();
            $this->load->view('CustomSearch/browse', $data);
    	}
    }  
}

?>