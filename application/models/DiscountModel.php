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

    public function getDiscountTotalAmount()
    {
        $this->db->from('discountevent');
        $count = $this->db->count_all_results();
        return $count;
    }

    public function browseLimit($offset, $limit)
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select("de.*, c.name as categoryName");
        $this->db->from('discountevent as de join category as c on de.cid=c.cid');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
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

    public function insertDiscount($cid, $name, $startTime, $endTime, $discount_rate)
    {
        $startTimeDate = strtotime($startTime);
        $endTimeDate = strtotime($endTime);
        if ($startTimeDate > $endTimeDate) {
            return false;
        }
        try {
            $discountData = array('cid' => $cid, 'name' => $name, 'startTime' => $startTime,
                'endTime' => $endTime, 'discount_rate' => $discount_rate);
            $this->db->insert('discountevent', $discountData);
            return true;
        }
        catch (exception $exception) {
            return false;
        }
    }

    public function updateDiscount($deid, $startTime, $endTime)
    {
        $data = array('startTime' => $startTime, 'endTime' => $endTime);
        $this->db->where('deid', $deid);
        $this->db->update('discountevent', $data);
    }

    public function update($deid, $cid, $name, $startTime, $endTime, $discountRate)
    {
        $startTimeDate = strtotime($startTime);
        $endTimeDate = strtotime($endTime);
        if ($startTimeDate > $endTimeDate) {
            return false;
        }
        try {
            $data = array('cid' => $cid, 'startTime' => $startTime, 'name' => $name,
                'startTime' => $startTime, 'endTime' => $endTime, 'discount_rate' => $discountRate);
            $this->db->where('deid', $deid);
            $this->db->update('discountevent', $data);
            return true;
        }
        catch (exception $exceptino) {
            return false;
        }
    }
}
?>