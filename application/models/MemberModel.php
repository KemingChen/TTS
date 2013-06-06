<?php

class MemberModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    
    public function index(){
        //echo "hello member";
    }
    
    
    public function register($data)
    {
        $this->db->insert('account', $data); 
    }
    
    public function modifyMemberInformation($mid, $data)
    {
        $this->db->where('mid', $mid);
        $this->db->update('account', $data);
    }
    
    public function getPasswordByEmail($email)
    {
        $this->db->select('name, password');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }
}

?>