<?php

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("BookModel");
        //上傳檔案要用的
        $this->load->helper(array('form','url'));
        $this->load->library('upload');
    }
    
    public function onShelf()
    {
        $ISBN = "1234567891234";//this need to be changed.
        $data["books"] = $this->BookModel->updateOnShelf($ISBN);
        $totalCount = $this->BookModel->countTotal();
        $this->load->view('Book/Browse', $data);
    }
    
    public function offShelf($ISBN)
    {
        //$ISBN = "1234567891234";//this need to be changed.
        $this->BookModel->updateOffShelf($ISBN);
        $this->load->view('Book/'.$page, $data);
    }
    
    public function createBookInformation()
    {
        $ISBN = "1234567891234";
        $cover = "cover";
        $name = "haha";
        $aid = 1;
        $pid = 1;
        $publishedDate = "2013/6/2";
        $price = "1000";
        $this->BookModel->createBookInformation($ISBN, $cover, $name, $aid, $pid, $publishedDate, $price);
    }
    
    public function editBookInformation()
    {
        $bid = 1;//change this to edit the book you want.
        $ISBN = "1234567891234";
        $cover = "cover";
        $name = "haha";
        $aid = 1;
        $pid = 1;
        $publishedDate = "2013/6/2";
        $price = "1000";
        $this->BookModel->editBookInformation($bid, $ISBN, $cover, $name, $aid, $pid, $publishedDate, $price);
    }
    
    public function searchByCategory()
    {
        $category = "Science";//needs to be changed.
        $start = 0;//從第幾筆
        $end = 30;//到第幾筆
        $query = $this->BookModel->searchByCategory($category, $start, $end);
        exit;
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "name: " . $row->name;
                echo ", cover: " . $row->cover;
                echo ", publishedDate: " . $row->publishedDate;
                echo ", price: " . $row->price;
                echo ", ISBN: " . $row->ISBN;
                echo ", onshelf: " . $row->onShelf . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "There's no any record!";  
        }
    }
    
    public function searchByID()
    {
        $id = 1;
        $query = $this->BookModel->searchByID($id);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "name: " . $row->name;
                echo ", cover: " . $row->cover;
                echo ", publishedDate: " . $row->publishedDate;
                echo ", price: " . $row->price;
                echo ", ISBN: " . $row->ISBN;
                echo ", onshelf: " . $row->onShelf . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "There's no any record!";  
        }
    }
    
    public function browseAllBooks()
    {
        $data["books"] = $this->BookModel->browseAllBooks();
        $this->load->view('Book/Browse', $data);
    }
}

?>