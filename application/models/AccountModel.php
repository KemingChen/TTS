<?php

class AccountModel extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    
    public function index(){
        //echo "hello account";
    }
    
    public function browseAccountList()
    {
        $this->db->select('mid, email, name, available, authority, zipCode, birthday, address');
        $this->db->from('account');
        $data = $this->db->get();
        return $data;
    }
    
    public function createAccount($data)
    {
        $this->db->insert('account', $data); 
    }
    
    public function modifyAuthority($mid, $data)
    {
        $this->db->where('mid', $mid);
        $this->db->update('account', $data);
    }
    
    public function freeze($mid)
    {
        $this->db->where('mid', $mid);
        $data = array(
                        'available' => 0
                     );
        $this->db->update('account', $data);
    }
    
    public function unfreeze($mid)
    {
        $this->db->where('mid', $mid);
        $data = array(
                        'available' => 1
                     );
        $this->db->update('account', $data);
    }
    
    public function getMemberInfoByAccount($email, $password)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', $email);
        $this->db->from('account');
        $data = $this->db->get();
        return $data;
    }
}

?>