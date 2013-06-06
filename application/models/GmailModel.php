<?php

class GmailModel extends CI_Model
{
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
    }
    
    public function index(){
        //echo "hello account";
    }
    
    public function sendMail($recipient, $subject, $message)
    {
        $this->email->from('taipeitech2013@gmail.com', 'TaipeiTech');
        $this->email->to($recipient); 
        $this->email->subject($subject);
        $this->email->message($message);  
        $this->email->send();
        echo $this->email->print_debugger();
    }
}

?>