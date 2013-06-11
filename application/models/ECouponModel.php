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