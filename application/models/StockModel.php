<?php

class StockModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function browseBooksStock()
    {
        $this->db->select('name, Sum( restAmount ) As stock');
        $this->db->from('stockrecord Left Join book On stockrecord.bid = book.bid');
        $this->db->group_by("stockrecord.bid"); 
        $data = $this->db->get();
        return $data;
    }
    
    public function browseStockRecord()
    {
        $this->db->select('*');
        $this->db->from('StockRecord');
        $data = $this->db->get();
        return $data;
    }
    
    public function addStockRecord()
    {
        $data = array(
            'bid' => $this->input->post('bid'),
            'price' => $this->input->post('price'),
            'amount' => $this->input->post('amount'),
            'restAmount' => $this->input->post('restAmount'),
            'stockTime' => $this->input->post('stockTime')
    	);
	    return $this->db->insert('stockRecord', $data);
    }
}
?>