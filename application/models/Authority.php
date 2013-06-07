<?php

class Authority extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function login($email, $password)
    {
        $this->load->model('accountModel');
        $users = $this->accountModel->getMemberInfoByAccount($email, $password);
        $userData = $users->result();
        if(count($userData) > 0 && $userData[0]->available == true)
        {
            $this->session->set_userdata($userData[0]);
            return true;
        }
        return false;
    }

    public function isLogin()
    {
        $email = $this->session->userdata('email');
        return $email != false ? true : false;
    }
    
    public function getEmail(){
        $email = $this->session->userdata('email');
        return $email;
    }

    public function getName(){
        $name = $this->session->userdata('name');
        return $name;
    }

    public function getBirthDate(){
        $birthDate = $this->session->userdata('birthday');
        return $birthDate;
    }
    
    public function getZipCode(){
        $zipCode = $this->session->userdata('zipCode');
        return $zipCode;
    }
    
    public function getAddress(){
        $address = $this->session->userdata('address');
        return $address;
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