<?php

class StockModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function browseBooksStock($limit,$offset)
    {
        $this->db->select('b.bid, name, SUM( restAmount ) AS stock');
        $this->db->from('book AS b');
        $this->db->join('stockrecord as s','b.bid=s.bid','left');
        $this->db->group_by("b.bid");
        $this->db->limit($limit,$offset); 
        $data['stocks'] = $this->db->get()->result();
        $data['total_num'] = $this->db->count_all('book');
        return $data;
    }
    
    public function browseStockRecord($limit,$offset)
    {
        $this->db->select('s.*,b.name, b.ISBN');
        $this->db->from('StockRecord as s');
        $this->db->join('book as b','b.bid=s.bid');
        $this->db->order_by('stockTime','desc');
        $this->db->limit($limit,$offset);
        $data["records"] = $data = $this->db->get()->result();
        $data['total_num'] = $this->db->count_all('StockRecord');
        return $data;
    }
    
    public function getStockTotalAmount()
    {
        $this->db->select('s.*,b.name, b.ISBN');
        $this->db->from('StockRecord as s');
        $this->db->join('book as b','b.bid=s.bid');
        $this->db->order_by('stockTime','desc');
        $count = $this->db->count_all_results();
        return $count;
    }
    
    public function addStockRecord($bid, $price, $amount)
    {
        $data = array(
            'bid' => $bid,
            'price' => $price,
            'amount' => $amount,
            'restAmount' => $amount,
            'stockTime' => date('Y-m-d')
    	);
	    return $this->db->insert('stockRecord', $data);
    }
}
?>