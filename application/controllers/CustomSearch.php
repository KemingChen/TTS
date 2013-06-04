<?php

class CustomSearch extends CI_Controller
{
    public function searchByAuthor()
    {
        $this->load->model('CustomSearchModel');
        $authorName = "haha";//needs to be changed.
        $query = $this->CustomSearchModel->searchByAuthor($authorName);
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
    
    public function searchByName()
    {
        $this->load->model('CustomSearchModel');
        $name = "haha";//needs to be changed.
        $query = $this->CustomSearchModel->searchByName($name);
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
    
    public function searchByBooksellers()
    {
        $this->load->model('CustomSearchModel');
        $bookseller = "haha";//needs to be changed.
        $query = $this->CustomSearchModel->searchByBooksellers($bookseller);
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
    
    public function searchByPublishedDate()
    {
        $this->load->model('CustomSearchModel');
        $date = "2013/06/02";//needs to be changed.
        $query = $this->CustomSearchModel->searchByPublishedDate($date);
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
    
    public function searchByCategory()
    {
        $this->load->model('CustomSearchModel');
        $category = "Science";//needs to be changed.
        $query = $this->CustomSearchModel->searchByCategory($category);
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