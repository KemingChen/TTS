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
    
    public function insertECoupon($quantity, $startTime, $endTime, $price)
    {  
        for($i=0;$i<$quantity;$i++)
        {
            $ecouponData = array(
                'couponCode' => $this->generateCouponCode(),
                'startTime' => $startTime,
                'endTime' => $endTime,
                'price' => $price
	       );
            if(!($this->db->insert('ecoupon', $ecouponData))) $i--;
        }
    }
    
    public function isExist($couponCode){
        $query = $this->db->get_where('ecoupon', array("couponCode"=>$couponCode));
        $list = $query->result();
        return count($list)>0;
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