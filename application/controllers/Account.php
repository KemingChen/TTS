<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
    
    public function browseAccountListByLimit()
    {
        $start = 0;
        $length = 10;
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
        $data = array(
                        'email' => "test123@hotmail.com",
                        'password' => "12345",
                        'authority' => 'customer',
                        'zipCode' => 123,
                        'birthday' => '2013/05/15',
                        'address' => "Taiwan",
                        'available' => 1,
                        'name' => "Date"
                     );
        $this->AccountModel->createAccount($data);
    }
    
    public function modifyAuthorityToAdmin($mid)
    {
        $data = array(
                        'authority' => 'administator'
                     );
        $this->AccountModel->modifyAuthority($mid, $data);
        $this->browseAccountList();
    }
    
    public function modifyAuthorityToManager($mid)
    {
        $data = array(
                        'authority' => 'manager'
                     );
        $this->AccountModel->modifyAuthority($mid, $data);
        $this->browseAccountList();
    }
    
    public function modifyAuthorityToCustomer($mid)
    {
        $data = array(
                        'authority' => 'customer'
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