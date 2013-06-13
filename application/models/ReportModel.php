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
    
    public function categorySellReport()
    {
        $this->db->select(" b.pid , p.name, SUM((soldPrice - cost) * quantity ) AS profit, SUM( quantity ) AS sold_amount");
        $this->db->from("ORDERITEM NATURAL JOIN book AS b JOIN publisher AS p ON b.pid = p.pid");
        $this->db->group_by('b.pid');
        $data = $this->db->get();
        return $data;
    }
    
    public function authorSellReport()
    {
        $this->db->select("name, SUM((soldPrice - cost) * quantity ) AS profit, SUM( quantity ) as quantity");
        $this->db->from("orderitem NATURAL JOIN writercorrespond NATURAL JOIN author");
        $this->db->group_by('aid');
        $this->db->order_by('profit', 'DESC');
        $data = $this->db->get();
        return $data;
    }
    
    public function revenueFromPromotionalActivities()
    {
        $data = $this->db->query("SELECT data.name as name, SUM(data.totalPrice) as total_price FROM (	SELECT corspd.*, event.name, (item.soldPrice-item.cost)*item.quantity AS totalPrice	FROM DISCOUNTCORRESPOND corspd INNER JOIN ORDERITEM item ON corspd.oid=item.oid AND corspd.bid=item.bid	INNER JOIN DISCOUNTEVENT event ON event.deid=corspd.deid) AS data GROUP BY data.deid ORDER BY data.deid DESC");
        return $data;
    }
    
    public function priceAdvice()
    {
        $this->db->select(" b.Name as name, Price as price, Cost as cost, SUM( quantity ) as quantity, discount_rate as discount_rate");
        $this->db->from("orderitem AS o NATURAL JOIN discountcorrespond NATURAL JOIN discountevent JOIN book AS b ON b.bid = o.bid");
        $this->db->group_by(' b.bid, deid');
        $data = $this->db->get();
        return $data;
    }
        


    public function getSalesByDay()
    {
        
    }
    
    public function getSalesByMonth()
    {
        
    }
    
    public function getSalesByYear()
    {
        
    }
}