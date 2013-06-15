<?php

class CustomSearchModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function searchByName($name, $offset = 0, $limit = 99999)
    {
        $this->db->from('book AS B');
        $this->db->like('B.name', "$name");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover');
        $this->db->from('book AS B');
        $this->db->like('B.name', "$name");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }

    public function searchByISBN($isbn, $offset=0, $limit=99999)
    {
        $this->db->from('book AS B');
        $this->db->where("B.ISBN = '$isbn'");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover, B.isbn');
        $this->db->from('book AS B');
        $this->db->where("B.ISBN = '$isbn'");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }
    
    public function searchByAuthor($authorName, $offset = 0, $limit = 99999)
    {
        $this->db->from('book AS B, author AS A');
        $this->db->join('writercorrespond AS W', 'W.bid=B.bid AND W.aid=A.aid' ,'inner');
        $this->db->like('A.name', "$authorName");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover');
        $this->db->from('book AS B, author AS A');
        $this->db->join('writercorrespond AS W', 'W.bid=B.bid AND W.aid=A.aid' ,'inner');
        $this->db->like('A.name', "$authorName");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }
    
    public function searchByBooksellers($sellerName, $offset=0, $limit=99999)
    {
        $this->db->from('book AS B');
        $this->db->join('publisher AS P', 'P.pid=B.pid' ,'inner');
        $this->db->like('P.name', "$sellerName");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover');
        $this->db->from('book AS B');
        $this->db->join('publisher AS P', 'P.pid=B.pid' ,'inner');
        $this->db->like('P.name', "$sellerName");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }

    public function searchByPublishedDate($publishedDate, $offset=0, $limit=99999)
    {
        $this->db->from('book AS B');
        $this->db->where("B.publishedDate = '$publishedDate'");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover');
        $this->db->from('book AS B');
        $this->db->where("B.publishedDate = '$publishedDate'");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }

    public function searchByCategory($category, $offset=0, $limit=99999)
    {
        $this->db->from('book AS B, category AS C');
        $this->db->join('categorycorrespond AS CR', 'CR.bid=B.bid AND CR.cid=C.cid' ,'inner');
        $this->db->where('C.cid', "$category");
        $data["total_NumRows"] = $this->db->count_all_results();
        
        $this->db->select('B.bid, B.name, B.cover');
        $this->db->from('book AS B, category AS C');
        $this->db->join('categorycorrespond AS CR', 'CR.bid=B.bid AND CR.cid=C.cid' ,'inner');
        $this->db->where('C.cid', "$category");
        $this->db->limit($limit, $offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }
}

?>