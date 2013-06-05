<?php

class Book extends CI_Controller
{
    /*public function index(){
        echo"hello";
    }*/
    
    public function onShelf()
    {
        $this->load->model('BookModel');
        $ISBN = "1234567891234";//this need to be changed.
        $this->BookModel->updateOnShelf($ISBN);
        
    }
    
    public function offShelf()
    {
        $this->load->model('BookModel');
        $ISBN = "1234567891234";//this need to be changed.
        $this->BookModel->updateOffShelf($ISBN);
    }
    
    public function createBookInformation()
    {
        $this->load->model('BookModel');
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
        $this->load->model('BookModel');
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
        $this->load->model('BookModel');
        $category = "Science";//needs to be changed.
        $start = 0;//從第幾筆
        $end = 30;//到第幾筆
        $query = $this->BookModel->searchByCategory($category, $start, $end);
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
        $this->load->model('BookModel');
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
}

?>