<?php

class ShoppingCart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ShoppingCartModel");
        $this->load->model("GmailModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function addShoppingCart()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/Add", array());
    	}
    	else
    	{
            $this->ShoppingCartModel->addShoppingCart();
            $data["records"] = $this->ShoppingCartModel->browseAllRecords();
            $this->load->view('shoppingCart/browse', $data);
    	}
    }
    
    public function removeShoppingCart()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/remove", array());
    	}
    	else
    	{
            $this->ShoppingCartModel->removeShoppingCart();
            $data["records"] = $this->ShoppingCartModel->browseAllRecords();
            $this->load->view('shoppingCart/browse', $data);
    	}
        //$mid = 1;//this need to be changed.
        //$bid = 1;//this need to be changed.
        //$this->ShoppingCartModel->removeShoppingCart($mid, $bid);
    }
    
    public function modifyShoppingCart()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/modify", array());
    	}
    	else
    	{
            $this->ShoppingCartModel->modifyShoppingCart();
            $data["records"] = $this->ShoppingCartModel->browseAllRecords();
            $this->load->view('shoppingCart/browse', $data);
    	}
    }
    
    public function clearShoppingCart()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/clear", array());
    	}
    	else
    	{
            $this->ShoppingCartModel->clearShoppingCart();
            $data["records"] = $this->ShoppingCartModel->browseAllRecords();
            $this->load->view('shoppingCart/browse', $data);
    	}
    }
    
    public function automaticConfirmationEmail()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/sendEmail", array());
    	}
    	else
    	{
            $info = $this->ShoppingCartModel->getCustomerInformation();
            foreach ($info->result() as $row)
            {
                $recipient =  $row->email;
                $name = $row->name;
            }
            $subject = 'TaipeiTech Store';
            $message = 'Hello, ' . $name . "\r\n" . 'confirmation';
            $this->GmailModel->sendMail($recipient, $subject, $message);
    	}
    }
    
    public function getWholeShoppingCart()
    {
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            //$this->load->library('../controllers/Nav');
            $this->load->view("shoppingCart/getShoppingCart", array());
    	}
    	else
    	{
            $data["records"] = $this->ShoppingCartModel->getWholeShoppingCart();
            $this->load->view('shoppingCart/browse', $data);
    	}
    }
    
}


?>