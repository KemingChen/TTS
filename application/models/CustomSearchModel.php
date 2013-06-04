<?php

class CustomSearchModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();

    }
    
    public function searchByAuthor($authorName)
    {
        $this->load->database();
        $query = $this->db->query("SELECT B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf FROM BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W WHERE A.name = '$authorName' AND W.aid = A.aid AND B.bid = W.bid");
        return $query;
    }
    
    public function searchByName($name)
    {
        $this->load->database();
        $query = $this->db->query("SELECT B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf FROM BOOK AS B WHERE B.name = '$name'");
        return $query;
    }
    
    public function searchByBooksellers($bookseller)
    {
        $this->load->database();
        $query = $this->db->query("SELECT B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf FROM BOOK AS B, PUBLISHER AS P WHERE P.name = '$bookseller' AND B.pid = P.pid");
        return $query;
    }
    
    public function searchByPublishedDate($date)
    {
        $this->load->database();
        $query = $this->db->query("SELECT B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf FROM BOOK AS B WHERE B.publishedDate = '$date'");
        return $query;
    }
    
    public function searchByCategory($category)
    {
        $this->load->database();
        $query = $this->db->query("SELECT B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf FROM BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC WHERE C.name = '$category' AND CC.cid = C.cid AND B.bid = CC.bid");
        return $query;
    }
}

?>