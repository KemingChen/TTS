<?php

class ReportModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function bookSellReport()
    {
        $this->db->select("B.name as name, SUM(OI.quantity) AS TOTAL_QUANTITY , SUM((OI.soldPrice - OI.cost)  * OI.quantity) AS profit");
        $this->db->from('BOOK AS B, ORDERITEM AS OI');
        $this->db->where("OI.bid = B.bid");
        $this->db->group_by('B.bid');
        $this->db->order_by('profit', 'DESC');
        $data = $this->db->get();
        return $data;
    }
    
    //public function categorySellReport()
//    {
//        $this->db->select(" b.pid, p.name, SUM((soldPrice - cost) * quantity ) AS profit, SUM( quantity ) AS sold_amount");
//        $this->db->from("ORDERITEM NATURAL JOIN book AS b JOIN publisher AS p ON b.pid = p.pi");
//        $this->db->
//    }
}