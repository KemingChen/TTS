<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("AccountModel");
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
    
    public function modifyAuthority($mid, $authority)
    {
        $data = array(
                        'authority' => $authority
                     );
        $this->AccountModel->modifyAuthority($mid, $data);
        $this->browseAccountList();
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
}

?>