<?php

class ECouponModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function browseSize()
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select('');
        $this->db->from('ecoupon');
        $data = $this->db->get();
        return $data;
    }
    
    public function browse($offset, $limit)
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select('');
        $this->db->from('ecoupon');
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseOne($ecid)
    {
        $this->db->select('');
        $this->db->from('ecoupon');
        $this->db->where('ecid', $ecid);
        $data = $this->db->get();
        return $data;
    }
    
    public function generateCouponCode()
    {
        $couponCode = uniqid();
        return $couponCode;
        //printf("uniqid(): %s\r\n", uniqid());
    }
    
    public function insertECoupon($couponCode, $startTime, $endTime, $price)
    {
        $ecouponData = array(
            'couponCode' => $couponCode,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'price' => $price
    	);
	    $this->db->insert('ecoupon', $ecouponData);
        //return $this->db->insert_id();
    }
    
    public function getCustomerInformation($mid)
    {
        $this->db->select('name, email');
        $this->db->from('account');
        $this->db->where('mid', $mid);
        $data = $this->db->get();
        return $data;
        
    }
    
    public function emailContent($ecid)
    {
        $this->db->select('e.couponCode, e.startTime, e.endTime, e.price');
        $this->db->from('ecoupon as e');
        $this->db->where("e.ecid = $ecid");
        
        //$this->db->select('sc.bid, b.name, SUM(sc.quantity) as totalQuantity, SUM(sc.quantity * b.price) as totalPrice');
        //$this->db->from('shoppingcartcorrespond as sc, book as b');
        //$this->db->where("sc.mid = $mid AND b.bid = sc.bid");
        //$this->db->group_by("sc.bid");
        $data = $this->db->get();
        return $data;
    }
    
    public function updateECoupon($ecid, $startTime, $endTime)
    {
        $data = array(
            'startTime' => $startTime,
            'endTime' => $endTime
        );
        $this->db->where('ecid', $ecid);
        $this->db->update('ecoupon', $data);
    }
}
?>