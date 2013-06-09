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
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('phoneNumber', 'phoneNumber', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/Register", array());
    	}
    	else
    	{
            $email = $this->MemberModel->register();
            $data['account'] = $this->MemberModel->getMemberInfoByEmail($email);
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function addPhone($mid, $phone)
    {
        $this->MemberModel->addPhone($mid, $phone);
    }
    
    public function modifyPhone($mid, $phone, $newPhone)
    {
        $this->MemberModel->modifyPhone($mid, $phone, $newPhone);
    }
    
    public function modifyMemberInfo()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ModifyMemberInformation", array());
    	}
    	else
    	{
            $email = $this->MemberModel->modifyMemberInfo();
            $data['account'] = $this->MemberModel->getMemberInfoByEmail($email);
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function modifyMemberPassword()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('newPassword', 'newPassword', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ModifyMemberPassword", array());
    	}
    	else
    	{
            $email = $this->MemberModel->modifyMemberPassword();
    	}
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
            $email = $this->input->post('email');
            $this->MemberModel->forgetPassword($email);
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
            $data['account'] = $this->MemberModel->getMemberInfoByEmailFromView();
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function browsePhoneByMid($mid)
    {
        $data['phone'] = $this->AccountModel->browsePhoneByMid($mid);
        if($data['phone']->num_rows() > 0)
        {
            $this->load->view('Account/BrowsePhoneByMid', $data);
        }
        else
        {
            show_error("no data");
        }
    }
}

?>