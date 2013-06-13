<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("AccountModel");
        $this->load->model("MemberModel");
    }
    
    public function index(){
        echo "hello account";
    }
    
    public function browseAccountList()
    {
        $data['account'] = $this->AccountModel->browseAccountList();
        if($data['account']->num_rows() > 0)
        {
            $this->load->view('Account/BrowseAccountList', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseAccountListByLimit($start, $length)
    {
        $data['account'] = $this->AccountModel->browseAccountListByLimit($start, $length);
        if($data['account']->num_rows() > 0)
        {
            $this->load->view('Account/BrowseAccountList', $data);
        }
        else
        {
            show_error("no data");
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
    
    public function createAccount()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('authority', 'authority', 'required');
        $this->form_validation->set_rules('available', 'available', 'required');
        $this->form_validation->set_rules('phoneNumber', 'phoneNumber', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Account/CreateAccount", array());
    	}
    	else
    	{
    	    $this->AccountModel->createAccount();
            $this->browseAccountList();
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
    
    
    public function modifyAuthority($mid, $authority)
    {
        $this->AccountModel->modifyAuthority($mid, $authority);
        //$this->browseAccountList();
    }
    
    public function freeze($mid)
    {
        $this->AccountModel->freeze($mid);
        $this->browseAccountList();
    }
    
    public function unfreeze($mid)
    {
        $this->AccountModel->unfreeze($mid);
        $this->browseAccountList();
    }
    
    public function getMemberInfoForEcoupon ($mid)
    {
        $memberResult = $this->AccountModel->getMemberInfoForEcoupon($mid);
        return $memberResult;
    }
    
    public function getValidMemberListForEcoupon()
    {
        $memberResultList = $this->AccountModel->getValidMemberForEcoupon();
        return $member;
    }
}

?>