<?php

class ConcernModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function queryConcernBooks($memberID,$num=10,$start=0)
    {
        //$data["books"] = $this->db->get('concern')->where('mid',$memberID)->limit($num, $start);
        $data["books"] = $this->db->get_where('concern', array('mid' => $memberID), $num, $start);
        $data["totalNum"] = $this->db->count_all('concern');
        $data["num"] = $this->db->count_all_results();
        return $data;
    }
}

?>