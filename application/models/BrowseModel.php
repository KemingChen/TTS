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
        $this->db->select('')->from('categorycorrespond')->where('cid',$categoryID);
        $data["total_num_rows"] = $this->db->count_all_results();
        
        $this->db->select('c.bid,name,cover');
        $this->db->from('categorycorrespond as c')->join('book','book.bid=c.bid','natural');
        $this->db->where('cid',$categoryID);
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get();
        $data["num_rows"] = $data["books"]->num_rows();
        $data["books"] = $data["books"]->result();
        return $data;
    }
    
    public function GetLatestBook($offset, $limit)
    {
        $data["total_num_rows"] = $this->db->count_all_results('book');
        //$data["total_num_rows"] = $this->db->count_all_results();

        $this->db->select('bid,name,cover');
        $this->db->from('book');
        $this->db->order_by('publishedDate','desc');
        $this->db->limit($limit,$offset);
        $data["books"] = $this->db->get();
        $data["num_rows"] = $data["books"]->num_rows();
        $data["books"] = $data["books"]->result();
        return $data;
    }
}
?>