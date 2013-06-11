<?php

class DiscountModel extends CI_Model
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
        $this->db->from('discountevent');
        $data = $this->db->get();
        return $data;
    }
    
    public function browse($offset, $limit)
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select('');
        $this->db->from('discountevent');
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseOne($deid)
    {
        $this->db->select('');
        $this->db->from('discountevent');
        $this->db->where('deid', $deid);
        $data = $this->db->get();
        return $data;
    }
    
    public function insertDiscount($cid, $name, $startTime, $endTime, $percentOff)
    {
        $discountData = array(
            'cid' => $cid,
            'name' => $name,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'percentOff' => $percentOff
    	);
	    $this->db->insert('discountevent', $discountData);
        //return $this->db->insert_id();
    }
    
    public function updateDiscount($deid, $startTime, $endTime)
    {
        $data = array(
            'startTime' => $startTime,
            'endTime' => $endTime
        );
        $this->db->where('deid', $deid);
        $this->db->update('discountevent', $data);
    }
}
?>