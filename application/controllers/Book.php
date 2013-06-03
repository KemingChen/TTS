<?php

class Book extends CI_Controller
{
    /*public function index(){
        echo"hello";
    }*/
    
    public function onShelf()
    {
        $this->load->model('BookModel');
        $ISBN = "1234567891234";
        $this->BookModel->updateOnShelf($ISBN);
        
    }
    
    public function offShelf()
    {
        $this->load->model('BookModel');
        $ISBN = "1234567891234";
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
    /*
    public function select()
    {
        $this->load->database();
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $query = $this->db->query("Select * From author");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "id: " . $row->aid;
                echo ", name: " . $row->name . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "haha  it's nothing";  
        }
    }
    */
}

?>