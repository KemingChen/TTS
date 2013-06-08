<?php

class CustomSearchModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function searchByAuthor($authorName)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W ');
        $this->db->where("A.name = '$authorName' AND W.aid = A.aid AND B.bid = W.bid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByName($name)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.name = '$name'");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByBooksellers($sellerName)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, PUBLISHER AS P');
        $this->db->where("P.name = '$sellerName' AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByPublishedDate($publishedDate)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.publishedDate = '$publishedDate'");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByCategory($category)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC');
        $this->db->where("C.name = '$category' AND CC.cid = C.cid AND B.bid = CC.bid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByISBN($isbn)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.ISBN = '$isbn'");
        $data = $this->db->get();
        return $data;
    }
}

?>