<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MemberModel");
        $this->load->model("GmailModel");
    }
    
    public function index(){
        echo "hello member";
    }
    
    public function register()
    {
        $data = array(
                        'email' => "test100@hotmail.com",
                        'password' => "12345",
                        'authority' => 'customer',
                        'zipCode' => 123,
                        'birthday' => '2013/05/15',
                        'address' => "Taiwan",
                        'available' => 1,
                        'name' => "Date"
                     );
        $this->MemberModel->register($data);
    }
    
    public function modifyMemberInformation()
    {
        $mid = 13;
        $data = array(
                        'email' => "test99@hotmail.com",
                        'password' => "54321",
                        'authority' => 'customer',
                        'zipCode' => 123,
                        'birthday' => '2013/05/15',
                        'address' => "Taiwan",
                        'available' => 1,
                        'name' => "Date"
                     );
        $this->MemberModel->modifyMemberInformation($mid, $data);
    }
    
    public function forgetPassword()
    {
        $recipient = 'j99590314@gmail.com';
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