<?php

class BookModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();

    }
    
    public function updateOnShelf($ISBN)
    {
        $this->load->database();
        $query = $this->db->query("Update book set onshelf = true where ISBN='$ISBN'");
    }
    
    public function updateOffShelf($ISBN)
    {
        $this->load->database();
        $query = $this->db->query("Update book set onshelf = false where ISBN='$ISBN'");
    }
    
    public function createBookInformation($ISBN, $cover, $name, $aid, $pid, $publishedDate, $price)
    {
        $this->load->database();
        $query = $this->db->query("Insert Into book Values('', '$cover', '$name', '$pid', '$publishedDate', '$price', '$ISBN', 'qweqweqwe', 1)");
    }
    
    public function editBookInformation($bid, $ISBN, $cover, $name, $aid, $pid, $publishedDate, $price)
    {
        $this->load->database();
        $query = $this->db->query("Update book set cover = '$cover', name = '$name', pid = $pid, publishedDate = '$publishedDate', price = $price, ISBN = '$ISBN', description = 'qweqweqwe', onShelf = 1 Where bid = $bid");
    }
}
?>