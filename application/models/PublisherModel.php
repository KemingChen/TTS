<?php

class PublisherModel extends CI_Model
{
    private $tableName = 'publisher';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllPublishers(){
        $this->db->select("pid, name");
        $this->db->from("publisher");
        $list = $this->db->get()->result();
        return $list;
    }
    
    public function ListPublishers($offset,$num)
    {
        $sql = 'SELECT * FROM publisher LIMIT '.$offset.' ,'.$num;
        $data["publishers"] = $this->db->query($sql);
        $data["total_NumRows"] = $this->db->count_all_results($this->tableName);
        $data["num_rows"] = $data["publishers"]->num_rows();
        return $data;
    }
    
    public function Browse($pid)
    {
        $data["publisher"] = $this->db->get_where($this->tableName,array('pid' => $pid))->row(0);
        return $data;
    }
    
    public function create($data)
    {
        $this->db->insert($this->tableName, $data); 
    }
    
    public function update($pid,$data)
    {
        $this->db->where('pid', $pid);
        $this->db->update($this->tableName, $data); 
    }
    
    public function delete($pid)
    {
        $data = array(
           'pid' => $pid
        );
        $this->db->delete($this->tableName, $data); 
    }
}

?>