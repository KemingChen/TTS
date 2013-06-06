<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MemberModel");
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
    
    public function logout()
    {
        
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
        $this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'taipeitech2013@gmail.com';
        $config['smtp_pass']    = 'qq13579qq';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('taipeitech2013@gmail.com', 'TaipeiTech');
        $this->email->to('j99590314@gmail.com'); 
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  
        $this->email->send();
        echo $this->email->print_debugger();
    }
}

?>