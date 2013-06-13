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

    public function browseLimit($offset, $limit)
    {
        //$this->db->select('deid, cid, name, startTime, endTime, percentOff');
        $this->db->select('');
        $this->db->from('rebateevent');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getRebateAmount()
    {
        $this->db->from('rebateevent');
        $count = $this->db->count_all_results();
        return $count;
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
        $startTimeDate = strtotime($startTime);
        $endTimeDate = strtotime($endTime);
        if ($startTimeDate > $endTimeDate) {
            return false;
        }


        try {
            $rebateData = array('name' => $name, 'startTime' => $startTime, 'endTime' => $endTime,
                'threshold' => $threshold, 'price' => $price);
            if ($threshold > $price) {
                $this->db->insert('rebateevent', $rebateData);
                return true;
            }
        }
        catch (exception $ex) {
            return false;
        }
        return false;

    }

    public function updateRebate($reid, $startTime, $endTime)
    {
        $data = array('startTime' => $startTime, 'endTime' => $endTime);
        $this->db->where('reid', $reid);
        $this->db->update('rebateevent', $data);
    }

    public function update($reid, $name, $startTime, $endTime, $threshold, $price)
    {
        $startTimeDate = strtotime($startTime);
        $endTimeDate = strtotime($endTime);
        if ($startTimeDate > $endTimeDate) {
            return false;
        }
        try {
            $data = array('name' => $name, 'startTime' => $startTime, 'endTime' => $endTime,
                'threshold' => $threshold, 'price' => $price);

            $this->db->where('reid', $reid);
            $this->db->update('rebateevent', $data);
            return true;
        }
        catch (exception $ex) {
            return false;
        }
    }
}
?>