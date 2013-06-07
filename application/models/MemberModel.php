<?php

class MemberModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model("GmailModel");
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
    
    public function getMemberInfoByEmail()
    {
        $emailData = array(
            'email' => $this->input->post('email'),
    	);
        $email = $emailData['email'];
        //$email = 'j99590314@gmail.com';
        $this->db->select('email, zipCode, birthday, address, name');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }
    
    public function getPasswordByEmail($email)
    {
        $this->db->select('name, password');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }
    
    public function forgetPassword()
    {
        $emailData = array(
            'email' => $this->input->post('email'),
    	);
        $recipient = $emailData['email'];
        $subject = 'TaipeiTech Store';
        $data = $this->MemberModel->getPasswordByEmail($recipient);
        $result = $data->result();
        $password = $result[0]->password;
        $name = $result[0]->name;
        $message = 'Hello, ' . $name . "\r\n" . 'your password:' . $password;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }
}

?>