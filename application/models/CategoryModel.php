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
}

?>