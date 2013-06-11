<?php

class RebateModel extends CI_Model
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
        $this->db->from('rebateevent');
        $data = $this->db->get();
        return $data;
    }
    
    public function browse($offset, $limit)
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select('');
        $this->db->from('rebateevent');
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseOne($reid)
    {
        $this->db->select('');
        $this->db->from('rebateevent');
        $this->db->where('reid', $reid);
        $data = $this->db->get();
        return $data;
    }
    
    public function insertRebate($name, $startTime, $endTime, $threshold, $price)
    {
        $rebateData = array(
            'name' => $name,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'threshold' => $threshold,
            'price' => $price
    	);
	    $this->db->insert('rebateevent', $rebateData);
        //return $this->db->insert_id();
    }
    
    public function updateRebate($reid, $startTime, $endTime)
    {
        $data = array(
            'startTime' => $startTime,
            'endTime' => $endTime
        );
        $this->db->where('reid', $reid);
        $this->db->update('rebateevent', $data);
    }
}
?>