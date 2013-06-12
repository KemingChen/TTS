<?php

class Authority extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('accountModel');
    }

    public function login($email, $password)
    {
        $users = $this->accountModel->getMemberInfoByAccount($email, $password);
        $userData = $users->result();
        if (count($userData) > 0 && $userData[0]->available == true) {
            $this->encode($userData[0]);
            $this->session->set_userdata($userData[0]);
            return true;
        }
        return false;
    }

    public function reload($password = "")
    {
        $email = $this->session->userdata("email");
        if ($password == "") {
            $password = $this->session->userdata("password");
        }
        $this->login($email, $password);
    }

    public function isLogin()
    {
        $email = $this->session->userdata('email');
        return $email != false ? true : false;
    }

    public function getPassword()
    {
        return $this->session->userdata("password");
    }

    public function getMemberID()
    {
        return $this->decode('mid');
    }

    public function getEmail()
    {
        return $this->decode('email');
    }

    public function getName()
    {
        return $this->decode('name');
    }

    public function getBirthDate()
    {
        return $this->decode('birthday');
    }

    public function getZipCode()
    {
        return $this->decode('zipCode');
    }

    public function getAddress()
    {
        return $this->decode('address');
    }

    public function getAuthority()
    {
        return $this->decode('authority');
    }

    public function logout()
    {
        $this->session->sess_destroy();
    }

    private function decode($key)
    {
        return urldecode($this->session->userdata($key));
    }

    private function encode(&$array)
    {
        foreach ($array as & $obj) {
            $obj = urlencode($obj);
        }
    }
}

?>