<?php

class ShoppingCart extends CI_Controller
{
    public function addShoppingCart()
    {
        $this->load->model('ShoppingCartModel');
        $mid = 1;//this need to be changed.
        $bid = 1;//this need to be changed.
        $quantity = 10;//this need to be changed.
        $this->ShoppingCartModel->addShoppingCart($mid, $bid, $quantity);
    }
    
    public function removeShoppingCart()
    {
        $this->load->model('ShoppingCartModel');
        $mid = 1;//this need to be changed.
        $bid = 1;//this need to be changed.
        $this->ShoppingCartModel->removeShoppingCart($mid, $bid);
    }
    
    public function modifyShoppingCart()
    {
        $this->load->model('ShoppingCartModel');
        $mid = 1;//this need to be changed.
        $bid = 1;//this need to be changed.
        $quantity = 5;//this need to be changed.
        $this->ShoppingCartModel->modifyShoppingCart($mid, $bid, $quantity);
    }
    
    public function clearShoppingCart()
    {
        $this->load->model('ShoppingCartModel');
        $mid = 1;//this need to be changed.
        $this->ShoppingCartModel->clearShoppingCart($mid);
    }
    
    public function automaticConfirmationEmail()
    {
        $this->load->model('ShoppingCartModel');
        $mid = 1;//this need to be changed.
        $this->ShoppingCartModel->automaticConfirmationEmail($mid);
    }
    
}


?>