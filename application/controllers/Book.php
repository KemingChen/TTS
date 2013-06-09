<?php

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BookModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation'); 
        $this->load->model("template");
        $this->load->model("template");
    }
    
    public function index()
    {
        $this->listAll();
    }
    
    public function listAll($offset=0,$limit=10)
    {
        $data = $this->BookModel->listAllBook($offset,$limit);
        $this->template->view("", "", "Book/ListAll", $data);
    }
    
    public function browse($bid)
    {
        $data = $this->BookModel->browse($bid);
        $this->template->view("", "", "Book/browse", $data);
    }
    
    public function listBooksOnShelf($offset=0,$limit=10)
    {
        $data = $this->BookModel->selectBooks_by_OnShelfAttr(TRUE,$offset=0,$limit=10);
        $this->load->view('Book/listBookOnShelf',$data);
    }
    
    public function listBooksOffShelf($offset=0,$limit=10)
    {
        $data = $this->BookModel->selectBooks_by_OnShelfAttr(FALSE,$offset=0,$limit=10);
        $this->load->view('Book/listBookOnShelf',$data);
    }
    
    public function onShelf($bid)
    {
        $this->BookModel->updateOnShelf($bid,true);
        $this->browse($bid);
    }

    public function offShelf($bid)
    {
        $this->BookModel->updateOnShelf($bid,false);
        $this->browse($bid);
    }
    
    public function create()
    {
    	$this->form_validation->set_rules('isbn', 'isbn', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->view("", "", "book/create", "");
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
        	if ( ! $this->upload->do_upload('cover'))
    		{
                show_error($this->upload->display_errors());
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                $cover = file_get_contents($data['upload_data']['full_path']);
                $bid = $this->BookModel->createBookInformation($cover);
                $this->browse($bid);
    		}
    	}
    }

    public function update($bid)
    {
        $this->form_validation->set_rules('isbn', 'isbn', 'required');
    	$data["bid"] = $bid;
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->view("", "", "book/update", $data);
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
        	if ( ! $this->upload->do_upload('cover'))
    		{
    			show_error($this->upload->display_errors());
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                $cover = file_get_contents($data['upload_data']['full_path']);
                
                $this->BookModel->editBookInformation($bid,$cover);
                $this->browse($bid);
    		}
    	}
    }
    
    public function insertCategory($bid, $cid)
    {
        $this->BookModel->insertCategory($bid, $cid);
        $this->browse($bid);
    }
    
    public function insertWriter($bid,$aid)
    {
        $this->BookModel->insertWriter($bid, $aid);
        $this->browse($bid);
    }
    
    public function insertTranslator($bid,$aid)
    {
        $this->BookModel->insertTranslator($bid, $aid);
        $this->browse($bid);
    }
}

?>