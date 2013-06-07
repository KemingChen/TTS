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
        //$authorName = $this->input->post('authorName');
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W ');
        $this->db->where("A.name = '$authorName' AND W.aid = A.aid AND B.bid = W.bid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByName($name)
    {
        //$name = $this->input->post('name');
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.name = '$name'");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByBooksellers($sellerName)
    {
        //$sellerName = $this->input->post('sellerName');
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, PUBLISHER AS P');
        $this->db->where("P.name = '$sellerName' AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByPublishedDate($publishedDate)
    {
        //$publishedDate = $this->input->post('publishedDate');
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.publishedDate = '$publishedDate'");
        $data = $this->db->get();
        return $data;
    }
    
    public function searchByCategory($category)
    {
        //$category = $this->input->post('category');
        //$publishedDate = $this->input->post('publishedDate');
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC');
        $this->db->where("C.name = '$category' AND CC.cid = C.cid AND B.bid = CC.bid");
        $data = $this->db->get();
        return $data;
    }
}

?>