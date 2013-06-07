<?php

class CustomSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CustomSearchModel");
        //�W���ɮ׭n�Ϊ�
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function searchByAuthor($authorName)
    {
        //$this->form_validation->set_rules('authorName', 'authorName', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->library('../controllers/Nav');
            //$this->load->view("CustomSearch/author", array());
    	//}
    	//else
    	//{
    	    $authorName = urldecode($authorName);
            $data["records"] = $this->CustomSearchModel->searchByAuthor($authorName);
            $this->load->view('CustomSearch/browse', $data);
    	//}
    }
    
    public function searchByName($name)
    {
        //$this->form_validation->set_rules('name', 'name', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->view("CustomSearch/name", array());
    	//}
    	//else
    	//{
            $data["records"] = $this->CustomSearchModel->searchByName($name);
            $this->load->view('CustomSearch/browse', $data);
    	//}
    }
    
    public function searchByBooksellers($sellerName)
    {
        //$this->form_validation->set_rules('sellerName', 'sellerName', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->view("CustomSearch/bookSeller", array());
    	//}
    	//else
    	//{
            $data["records"] = $this->CustomSearchModel->searchByBooksellers($sellerName);
            $this->load->view('CustomSearch/browse', $data);
    	//}
    }
    
    public function searchByPublishedDate($publishedDate)
    {
        //$this->form_validation->set_rules('publishedDate', 'publishedDate', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->view("CustomSearch/publishedDate", array());
    	//}
    	//else
    	//{
            $data["records"] = $this->CustomSearchModel->searchByPublishedDate($publishedDate);
            $this->load->view('CustomSearch/browse', $data);
    	//}
    }  
    
    public function searchByCategory($category)
    {
        //$this->form_validation->set_rules('category', 'category', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->view("CustomSearch/category", array());
    	//}
    	//else
    	//{
            $data["records"] = $this->CustomSearchModel->searchByCategory($category);
            $this->load->view('CustomSearch/browse', $data);
    	//}
    }  
}

?>