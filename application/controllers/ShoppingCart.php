<?php

class ShoppingCart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ShoppingCartModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function addShoppingCart()
    {
        //$mid = 1;//this need to be changed.
        //$bid = 1;//this need to be changed.
        //$quantity = 10;//this need to be changed.
        $this->form_validation->set_rules('mid', 'mid', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->library('../controllers/Nav');
            $this->nav->view("", "Category", "shoppingCart/Add", array());
    	}
    	else
    	{
            $this->ShoppingCartModel->addShoppingCart();
            $mid = $this->input->post('mid');
            $bid = $this->input->post('bid');
            $data["records"] = $this->ShoppingCartModel->browseAllRecords();
            $this->load->view('shoppingCart/browse', $data);
    	}
    }
    
    public function removeShoppingCart()
    {
        $mid = 1;//this need to be changed.
        $bid = 1;//this need to be changed.
        $this->ShoppingCartModel->removeShoppingCart($mid, $bid);
    }
    
    public function modifyShoppingCart()
    {
        $mid = 1;//this need to be changed.
        $bid = 1;//this need to be changed.
        $quantity = 5;//this need to be changed.
        $this->ShoppingCartModel->modifyShoppingCart($mid, $bid, $quantity);
    }
    
    public function clearShoppingCart()
    {
        $mid = 1;//this need to be changed.
        $this->ShoppingCartModel->clearShoppingCart($mid);
    }
    
    public function automaticConfirmationEmail()
    {
        $mid = 1;//this need to be changed.
        $this->ShoppingCartModel->automaticConfirmationEmail($mid);
    }
    
}


?>