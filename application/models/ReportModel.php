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
        $this->db->select("B.name as name , SUM((OI.soldPrice - OI.cost)  * OI.quantity) AS profit");
        $this->db->from('BOOK AS B, ORDERITEM AS OI');
        $this->db->where("OI.bid = B.bid");
        $this->db->group_by('B.bid');
        $this->db->order_by('profit', 'DESC');
        $data["report"] = $this->db->get()->result();
        return $data;
    }
    
    public function publisherSellReport()
    {
        $this->db->select(" p.name, SUM((soldPrice - cost) * quantity ) AS profit");
        $this->db->from("ORDERITEM NATURAL JOIN book AS b JOIN publisher AS p ON b.pid = p.pid");
        $this->db->group_by('b.pid');
        $data["report"] = $this->db->get()->result();
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
    
    public function getOrderQuantityByRebateEvent()
    {
        $this->db->select("count(oid) as count");
        $this->db->from("rebateCorrespond");
        $data = $this->db->get();
        return $data;
    }
    
    public function eCouponUtility()
    {
        $maxCount = $this->db->query("SELECT  CASE	WHEN MAX(e.ecid) >= COUNT(ec.oid) THEN  MAX(e.ecid) WHEN MAX(e.ecid) < COUNT(ec.oid) THEN COUNT(ec.oid) END as count FROM ecoupon as e , ecouponcorrespond as ec")->result();
        $used = $this->db->query("SELECT count(ec.oid) as count FROM ecouponcorrespond as ec")->result();
        if($maxCount[0]->count != 0)$data = $used[0]->count / $maxCount[0]->count;
        return $data;
    }   

    public function getProfitByDate($date)
    {
        $queryString = "select sum(totalPrice) as totalPrice ,sum(cost) as totalCost from(
                        SELECT oid,totalPrice,sum(cost*quantity) as cost,totalPrice-cost as profit 
                        FROM ordersummary natural join orderitem WHERE orderTime = '".$date."' group by oid 
                        )as temp";
        $query = $this->db->query($queryString);
        $queryResult = $query->result();
        $profit = $queryResult[0]->totalPrice - $queryResult[0]->totalCost;
        return $profit > 0 ? $profit : 0;
    }
    
    public function getProfitByYearAndMonth($year, $month)
    {
       $queryString = "select sum(totalPrice) as totalPrice ,sum(cost) as totalCost from(
                        SELECT oid,totalPrice,sum(cost*quantity) as cost,totalPrice-cost as profit 
                        FROM ordersummary natural join orderitem WHERE year(orderTime) = '".$year."' AND month(orderTime) = '".$month."' group by oid 
                        )as temp";
        $query = $this->db->query($queryString);
        $queryResult = $query->result();
        $profit = $queryResult[0]->totalPrice - $queryResult[0]->totalCost;
        return $profit > 0 ? $profit : 0;
    }
    
    public function getProfitByYear($year)
    {
        $queryString = "select sum(totalPrice) as totalPrice ,sum(cost) as totalCost from(
                        SELECT oid,totalPrice,sum(cost*quantity) as cost,totalPrice-cost as profit 
                        FROM ordersummary natural join orderitem WHERE year(orderTime) = '".$year."' group by oid 
                        )as temp";
        $query = $this->db->query($queryString);
        $queryResult = $query->result();
        $profit = $queryResult[0]->totalPrice - $queryResult[0]->totalCost;
        return $profit > 0 ? $profit : 0;
    }
    
    public function getTurnoverByDate($date)
    {
        $this->db->select('SUM(totalPrice) as turnover');
        $this->db->from('ordersummary');
        $this->db->where('orderTime', $date);
        $dataResult = $this->db->get()->result();
        return count($dataResult) > 0 ? $dataResult[0]->turnover : 0;
    }
    
    public function getTurnoverByYearAndMonth($year, $month)
    {
        $this->db->select('SUM(totalPrice) as turnover');
        $this->db->from('ordersummary');
        $this->db->where('month(orderTime)', $month);
        $this->db->where('year(orderTime)', $year);
        $dataResult = $this->db->get()->result();
        return count($dataResult) > 0 ? $dataResult[0]->turnover : 0;
    }
    
    public function getTurnoverByYear($year)
    {
        $this->db->select('SUM(totalPrice) as turnover');
        $this->db->from('ordersummary');
        $this->db->where('year(orderTime)', $year);
        $dataResult = $this->db->get()->result();
        return count($dataResult) > 0 ? $dataResult[0]->turnover : 0;
    }
    
    public function getEveryMonthTurnoverByYear($year)
    {
        $data = array(
                        '1' => $this->getTurnoverByYearAndMonth($year, 1),
                        '2' => $this->getTurnoverByYearAndMonth($year, 2),
                        '3' => $this->getTurnoverByYearAndMonth($year, 3),
                        '4' => $this->getTurnoverByYearAndMonth($year, 4),
                        '5' => $this->getTurnoverByYearAndMonth($year, 5),
                        '6' => $this->getTurnoverByYearAndMonth($year, 6),
                        '7' => $this->getTurnoverByYearAndMonth($year, 7),
                        '8' => $this->getTurnoverByYearAndMonth($year, 8),
                        '9' => $this->getTurnoverByYearAndMonth($year, 9),
                        '10' => $this->getTurnoverByYearAndMonth($year, 10),
                        '11' => $this->getTurnoverByYearAndMonth($year, 11),
                        '12' => $this->getTurnoverByYearAndMonth($year, 12)
        );
        return $data;
    }
}