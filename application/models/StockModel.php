<?php

class StockModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();

    }
    
    public function browseBooksStock()
    {
        $this->load->database();
        $query = $this->db->query("Select name, Sum( restAmount ) As stock From stockrecord Left Join book On stockrecord.bid = book.bid Group By stockrecord.bid");
        return $query;
    }
    
    public function browseStockRecord()
    {
        $this->load->database();
        $query = $this->db->query("Select * From StockRecord");
        return $query;
    }
    
    public function addStockRecord($bid, $price, $amount, $restAmount, $stockTime)
    {
        $this->load->database();
        $query = $this->db->query("Insert Into stockRecord Values('', $bid, $price, $amount, $restAmount, '$stockTime')");
    }
}
?>