<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ForgetPassword", array());
    	}
    	else
    	{
            $this->MemberModel->forgetPassword();
    	}
    }
    
    public function browseMemberInfo()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/BrowseMemberInfo", array());
    	}
    	else
    	{
            $data['account'] = $this->MemberModel->getMemberInfoByEmail();
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
}

?>