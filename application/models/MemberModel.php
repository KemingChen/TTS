<?php

class MemberModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model("GmailModel");
        $this->load->model("AccountModel");
    }
    
    public function index(){
        //echo "hello member";
    }
    
    public function register()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'authority' => 'customer',
            'zipCode' => $this->input->post('zipCode'),
            'birthday' => $this->input->post('birthday'),
            'address' => $this->input->post('address'),
            'available' => 1,
            'name' => $this->input->post('name')
    	);
        $this->db->insert('Account', $data);
        return $data['email'];
    }
    
    public function addPhone($mid, $phone)
    {
        $data = array(
            'mid' => $mid,
            'phoneNumber' => $phone
    	);
        $this->db->insert('cellphonenumbercorrespond', $data);
    }
    
    public function modifyMemberInfo()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'zipCode' => $this->input->post('zipCode'),
            'birthday' => $this->input->post('birthday'),
            'address' => $this->input->post('address'),
            'name' => $this->input->post('name')
    	);
        $email = $data['email'];
        $this->db->where('email', $email);
        $this->db->update('Account', $data);
        return $email;
    }
    
    public function modifyMemberPassword()
    {
        $data = array(
                        'email' => $this->input->post('email'),
                        'password' => $this->input->post('password'),
                        'newPassword' => $this->input->post('newPassword')
    	             );
        $email = $data['email'];
        $password = $data['password'];
        $newPassword = $data['newPassword'];
        $newData = array(
                        'password' => $newPassword
    	                );
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->update('Account', $newData);
    }
    
    public function getMemberInfoByEmailFromView()
    {
        $emailData = array(
            'email' => $this->input->post('email'),
    	);
        $email = $emailData['email'];
        $this->db->select('email, zipCode, birthday, address, name');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }
    
    public function getMemberInfoByEmail($email)
    {
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