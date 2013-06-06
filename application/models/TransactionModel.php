<?php

class TransactionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    
    public function index(){
        //echo "hello transaction";
    }

    public function browseTransactionRecords()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByLimit($min, $max)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('oid >=', $min);
        $this->db->where('oid <=', $max);
        $data = $this->db->get();
        return $data;
    }
    
    public function cancelTheTransaction($oid)
    {
        $this->db->where('oid', $oid);
        $this->db->delete('orderSummary'); 
    }
}

?>