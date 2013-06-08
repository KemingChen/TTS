<?php

class CategoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getCategoryArray()
    {
        return $this->db->get('category');
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