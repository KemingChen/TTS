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
        $this->db->select('B.bid, B.name, A.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('A.name', "$authorName");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByName($name)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p ');
        $this->db->like('B.name', "$name");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        //$this->db->where("B.name = '$name'");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByBooksellers($sellerName)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, PUBLISHER AS P, author as a, WRITERCORRESPOND AS W');
        $this->db->like('P.name', "$sellerName");
        $this->db->where("B.pid = P.pid AND W.aid = A.aid AND B.bid = W.bid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByPublishedDate($publishedDate)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->where("B.publishedDate = '$publishedDate' AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByCategory($category)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('C.name', $category);
        $this->db->where("CC.cid = C.cid AND B.bid = CC.bid AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByISBN($isbn)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->where("B.ISBN = '$isbn' AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }
}

?>