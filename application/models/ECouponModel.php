<?php

class ECouponModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
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
        return strtoupper($couponCode);
        //printf("uniqid(): %s\r\n", uniqid());
    }

    public function insertECoupon($CouponCode, $startTime, $endTime, $price)
    {
        $ecouponData = array('couponCode' => $CouponCode, 'startTime' => $startTime,
            'endTime' => $endTime, 'price' => $price);
        $this->db->insert('ecoupon', $ecouponData);
    }

    public function isExist($couponCode)
    {
        $datestring = "%Y-%m-%d";
        $now = now();
        $now = mdate($datestring, $now);
        //echo $now;
        $this->db->select('ecid');
        $this->db->from('ecoupon');
        $this->db->where('startTime <=', $now);
        $this->db->where('endTime >=', $now);
        $this->db->where('couponCode', $couponCode);
        $dataResult = $this->db->get()->result();
        return count($dataResult) > 0;
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
        $data = array('startTime' => $startTime, 'endTime' => $endTime);
        $this->db->where('ecid', $ecid);
        $this->db->update('ecoupon', $data);
    }
}

?>