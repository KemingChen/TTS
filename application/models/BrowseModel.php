<?php

class BrowseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function GetBookByCategory($categoryID, $offset, $limit)
    {
        $this->db->select('c.bid,name,cover');
        $this->db->from('categorycorrespond as c')->join('book','book.bid=c.bid','natural');
        $this->db->where('cid',$categoryID);
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();
        return $data;
    }
    
    public function GetLatestBook($offset, $limit)
    {
        $data["total_num_rows"] = $this->db->count_all_results('book');
        $this->db->select('bid,name,cover');
        $this->db->from('book');
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get();
        $data["books"] = $data["books"]->result();
        return $data;
    }
    
    public function GetMostConcernedBook($offset, $limit)
    {
        $this->db->select('bid,name,cover');
        $this->db->from('concern NATURAL JOIN book');
        $this->db->group_by('bid');
        $this->db->order_by('COUNT(bid)','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();;
        $this->db->select('')->from('concern NATURAL JOIN book')->group_by('bid');
        $data["total_num_rows"] = $this->db->get()->num_rows();
        return $data;
    }
    
    public function GetHotRankingBook($offset, $limit)
    {
        $this->db->select('bid,name,cover');
        $this->db->from('orderitem NATURAL JOIN book');
        $this->db->group_by('bid');
        $this->db->order_by('COUNT(bid)','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();;
        $this->db->select('')->from('orderitem NATURAL JOIN book')->group_by('bid');
        $data["total_num_rows"] = $this->db->get()->num_rows();
        return $data;
    }
}
?>