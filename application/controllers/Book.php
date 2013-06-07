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
    }

    public function onShelf($bid)
    {
        //$ISBN = "1234567891234"; //this need to be changed.
        $this->BookModel->updateOnShelf($bid);
        $data["book"] = $this->BookModel->browseSelectedBook($bid);
        $this->load->view('Book/BrowseABook', $data);
    }

    public function offShelf($bid)
    {
        //$ISBN = "1234567891234"; //this need to be changed.
        $this->BookModel->updateOffShelf($bid);
        $data["book"] = $this->BookModel->browseSelectedBook($bid);
        $this->load->view('Book/BrowseABook', $data);
    }

    public function createBookInformation()
    {
    	$this->form_validation->set_rules('isbn', 'isbn', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("book/create", array());
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
        	if ( ! $this->upload->do_upload('cover'))
    		{
    			$error = array('error' => $this->upload->display_errors());
                $this->template->uCSliderBar("Annoucement/create", $error);
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                $cover = file_get_contents($data['upload_data']['full_path']);
                
                $this->BookModel->createBookInformation($cover);
                $isbn = $this->input->post('isbn');
                $data["book"] = $this->BookModel->browseSelectedBook($isbn);
                $this->load->view('Book/BrowseABook', $data);
    		}
    	}
    }

    public function editBookInformation()
    {
        $this->form_validation->set_rules('isbn', 'isbn', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
    	    //$this->load->library('../controllers/Nav');
            $this->load->view("book/update", array());
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
        	if ( ! $this->upload->do_upload('cover'))
    		{
    			$error = array('error' => $this->upload->display_errors());
                $this->template->uCSliderBar("Annoucement/update", $error);
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                $cover = file_get_contents($data['upload_data']['full_path']);
                
                $this->BookModel->editBookInformation($cover);
                $isbn = $this->input->post('isbn');
                $data["book"] = $this->BookModel->browseSelectedBook($isbn);
                $this->load->view('Book/BrowseABook', $data);
    		}
    	}
    }

    public function searchByCategory($categoryID, $limit, $offset)
    {
        $data["books"] = $this->BookModel->searchByCategory($categoryID, $limit, $offset);
        $this->load->view('book/browse', $data);
    }

    public function searchByID($id, $limit, $offset)
    {
        $data["books"] = $this->BookModel->searchByID($id, $limit, $offset);
        $this->load->view('Book/Browse', $data);
    }

    public function browseAllBooks()
    {
        $data["books"] = $this->BookModel->browseAllBooks();
        $this->load->view('Book/Browse', $data);
    }
}

?>