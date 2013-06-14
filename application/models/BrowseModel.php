<?php

class BrowseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function GetBookByCategory($categoryID, $offset, $limit,$return_total_num=TRUE)
    {
        $this->db->select('c.bid,name,cover');
        $this->db->from('categorycorrespond as c')->join('book','book.bid=c.bid','natural');
        $this->db->where('cid',$categoryID);
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();
        if($return_total_num)
        {
            $this->db->from('categorycorrespond as c')->join('book','book.bid=c.bid','natural');
            $this->db->where('cid',$categoryID);
            $data["total_num_rows"] = $this->db->count_all_results();
        }
        return $data;
    }
    
    public function GetLatestBook($offset, $limit,$return_total_num=true)
    {
        if($return_total_num)
        $data["total_num_rows"] = $this->db->count_all_results('book');
        $this->db->select('bid,name,cover');
        $this->db->from('book');
        $this->db->where('onShelf = 1');
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get();
        $data["books"] = $data["books"]->result();
        return $data;
    }
    
    public function GetMostConcernedBook($offset, $limit,$return_total_num=true)
    {
        $this->db->select('bid,name,cover');
        $this->db->from('concern NATURAL JOIN book');
        $this->db->group_by('bid');
        $this->db->order_by('COUNT(bid)','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();
        if($return_total_num)
        {
            $this->db->select('')->from('concern NATURAL JOIN book')->group_by('bid');
            $data["total_num_rows"] = $this->db->get()->num_rows();
        }
        return $data;
    }
    
    public function GetHotRankingBook($offset, $limit,$return_total_num=true)
    {
        $this->db->select('bid,name,cover');
        $this->db->from('orderitem NATURAL JOIN book');
        $this->db->group_by('bid');
        $this->db->order_by('COUNT(bid)','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get()->result();
        
        if($return_total_num)
        {
            $this->db->select('')->from('orderitem NATURAL JOIN book')->group_by('bid');
            $data["total_num_rows"] = $this->db->get()->num_rows();
        }
        return $data;
    }
}
?>