<?php

class AccountModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index()
    {
        //echo "hello account";
    }

    public function browseAccountList()
    {
        $this->db->select('mid, email, name, available, authority, zipCode, birthday, address');
        $this->db->from('account');
        $data = $this->db->get();
        return $data;
    }

    public function browseAccountListByLimit($start, $length)
    {
        $this->db->select('*');
        $this->db->from('account');
        $this->db->limit($length, $start);
        $data = $this->db->get();
        return $data;
    }
    
    public function createAccount()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'authority' => $this->input->post('authority'),
            'zipCode' => $this->input->post('zipCode'),
            'birthday' => $this->input->post('birthday'),
            'address' => $this->input->post('address'),
            'available' => $this->input->post('available'),
            'name' => $this->input->post('name')
    	);
	    $this->db->insert('Account', $data);
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
        $this->db->select('email,authority,available,name, address, zipCode, birthday');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->from('account');
        $data = $this->db->get();
        return $data;
    }
}

?>