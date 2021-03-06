<?php

class ConcernModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function queryConcernBooks($memberID,$offset,$num)
    {
        $sql = 'SELECT bid, ISBN, name, price FROM book NATURAL JOIN concern WHERE mid ='.$memberID.' LIMIT '.$offset.' ,'.$num;
        $this->db->select('')->from('concern')->where('mid',$memberID);
        $data["total_NumRows"] = $this->db->get()->num_rows();
        $data["books"] = $this->db->query($sql)->result();
        return $data;
    }
    
    public function addBook($memberID,$bid)
    {
        $data = array(
           'mid' => $memberID ,
           'bid' => $bid 
        );
        $this->db->insert('concern', $data); 
    }
    
    public function deleteBook($memberID,$bid)
    {
        $data = array(
           'mid' => $memberID ,
           'bid' => $bid 
        );
        $this->db->delete('concern', $data); 
    }
}

?>