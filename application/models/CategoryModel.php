<?php

class CategoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getCategoriesByBid($bid){
        $query = $this->db->get_where('categorycorrespond', array('bid'=>$bid));
        $result = $query->result();
        return $result;
    }
    
    public function getCategoryArray()
    {
        return $this->db->get('category');
    }
    
    public function getCategoryList()
    {
        $this->db->cache_on();
        $data = $this->db->get('category')->result();
        $this->db->cache_off();
        return $data;
    }
    
    public function getCategorySize($cid){
        $total_num_rows = $this->db->count_all_results('category');
        return $total_num_rows;
    }
    
    public function getCategoryName($cid){
        $query = $this->db->get_where('category', array('cid' => $cid));
        foreach($query->result() as $row){
            return $row->name;
        }
        return "";
    }
}

?>