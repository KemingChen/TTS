<?php

class Authority extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    public function login($userData)
    {
        $this->session->set_userdata($userData);
    }
    
    public function isLogin()
    {
        $email = $this->session->userdata('email');
        return $email != false ? true : false;
    }
    
    public function getMemberData()
    {
        
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
    }
}

?>