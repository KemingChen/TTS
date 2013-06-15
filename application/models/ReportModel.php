<?php

class ReportModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
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
        $data["report"] = $this->db->query("SELECT data.name as name, SUM(data.totalPrice) as total_price FROM (	SELECT corspd.*, event.name, (item.soldPrice-item.cost)*item.quantity AS totalPrice	FROM DISCOUNTCORRESPOND corspd INNER JOIN ORDERITEM item ON corspd.oid=item.oid AND corspd.bid=item.bid	INNER JOIN DISCOUNTEVENT event ON event.deid=corspd.deid) AS data GROUP BY data.deid ORDER BY data.deid DESC")->result();
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
    
    public function eCouponUnUsedAmount()
    {
        $data["report"] = $this->db->query("SELECT count(e.ecid) as count FROM ecoupon as e")->result();
        //$correspondCount = $this->db->query("SELECT count(oid) FROM ecouponcorrepond")->result();
        $used = $this->db->query("SELECT count(ec.oid) as count FROM ecouponcorrespond as ec")->result();
        //if($couponCount[0]->count != 0)$data["report"] = $used[0]->count / ($used[0]->count + $couponCount[0]->count);
        //$data = ($used[0]->count + $couponCount[0]->count);
        return $data;
    }
    
    public function eCouponUsedAmount()
    {
        $data["report"] = $this->db->query("SELECT count(ec.oid) as count FROM ecouponcorrespond as ec")->result();
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
        $this->db->select('month(orderTime) as month, SUM(totalPrice) as turnover');
        $this->db->from('ordersummary');
        $this->db->where('year(orderTime)', $year);
        $this->db->group_by('month(orderTime)');
        $data["report"] = $this->db->get()->result();
        return $data;
    }
    
    public function getEveryDayTurnoverByYearAndMonth($year, $month)
    {
        $this->db->select('orderTime as date, SUM(totalPrice) as turnover');
        $this->db->from('ordersummary');
        $this->db->where('year(orderTime)', $year);
        $this->db->where('month(orderTime)', $month);
        $this->db->group_by('orderTime');
        $data["report"] = $this->db->get()->result();
        return $data;
    }
    
    public function getBookTurnoverByDate($date)
    {
        $this->db->select('b.name as name, SUM(oi.quantity * oi.soldPrice) as turnover');
        $this->db->from('ordersummary as os, orderItem as oi, book as b');
        $this->db->where("os.orderTime = '$date' AND os.oid = oi.oid AND oi.bid = b.bid");
        $this->db->group_by('oi.bid');
        $data["report"] = $this->db->get()->result();
        return $data;
    }
    
    public function getRebateEventReport()
    {
        $this->db->select('re.name, SUM(os.totalPrice) as turnover');
        $this->db->from('ordersummary as os, rebateevent as re, rebatecorrespond as rc');
        $this->db->where("os.oid = rc.oid AND rc.reid = re.reid");
        $this->db->group_by('rc.reid');
        $data["report"] = $this->db->get()->result();
        return $data;
    }
}