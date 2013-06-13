<?php

class AuthorModel extends CI_Model
{
    private $tableName = 'author';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function ListAuthors($offset,$num)
    {
        $sql = 'SELECT * FROM author LIMIT '.$offset.' ,'.$num;
        $data["authors"] = $this->db->query($sql);
        $data["total_NumRows"] = $this->db->count_all_results($this->tableName);
        $data["num_rows"] = $data["authors"]->num_rows();
        return $data;
    }
    
    public function Browse($aid)
    {
        $data["author"] = $this->db->get_where($this->tableName,array('aid' => $aid))->row(0);
        return $data;
    }
    
    public function create($data)
    {
        $this->db->insert($this->tableName, $data); 
    }
    
    public function update($aid,$data)
    {
        $this->db->where('aid', $aid);
        $this->db->update($this->tableName, $data); 
    }
    
    public function delete($aid)
    {
        $data = array(
           'aid' => $aid
        );
        $this->db->delete($this->tableName, $data); 
    }
    
    public function getTranslatorList()
    {
        $this->db->select('a.aid, a.name, a.introduction');
        $this->db->from('translatorcorrespond as tc, author as a');
        $this->db->where("tc.aid = a.aid");
    }
    
    public function getWriterList()
    {
        $this->db->select('a.aid, a.name, a.introduction');
        $this->db->from('writercorrespond as wc, author as a');
        $this->db->where("wc.aid = a.aid");
    }
}

?>