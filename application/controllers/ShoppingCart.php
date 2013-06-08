<?php

class ShoppingCart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ShoppingCartModel");
        $this->load->model("template");
        $this->load->model("GmailModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function addShoppingCart($mid, $bid, $quantity)
    {
        $this->ShoppingCartModel->addShoppingCart($mid, $bid, $quantity);
        $data["records"] = $this->ShoppingCartModel->browseAllRecords();
        $this->load->view('shoppingCart/browse', $data);
    }
    
    public function removeShoppingCart($mid, $bid)
    {
        $this->ShoppingCartModel->removeShoppingCart($mid, $bid);
        $data["records"] = $this->ShoppingCartModel->browseAllRecords();
        $this->load->view('shoppingCart/browse', $data);
    }
    
    public function modifyShoppingCart($mid, $bid, $quantity)
    {
        $this->ShoppingCartModel->modifyShoppingCart($mid, $bid, $quantity);
        $data["records"] = $this->ShoppingCartModel->browseAllRecords();
        $this->load->view('shoppingCart/browse', $data);
    }
    
    public function clearShoppingCart($mid)
    {
        $this->ShoppingCartModel->clearShoppingCart($mid);
        $data["records"] = $this->ShoppingCartModel->browseAllRecords();
        $this->load->view('shoppingCart/browse', $data);
    }
    
    public function automaticConfirmationEmail($mid)
    {
        $info = $this->ShoppingCartModel->getCustomerInformation($mid);
        $data["book"] = $this->ShoppingCartModel->confirmEmailContent($mid);
        $bookInfo = '';
        foreach ($data["book"]->result() as $row)
        {
            $bookName = $row->name;
            $totalQuantity = $row->totalQuantity;
            $totalPrice = $row->totalPrice;
            $bookInfo = $bookInfo . 'name: ' . $bookName . '  totalQuantity: ' . $totalQuantity . '  totalPrice: ' . $totalPrice . "\r\n";
        }
        foreach ($info->result() as $row)
        {
            $recipient =  $row->email;
            $name = $row->name;
        }
        $subject = 'TaipeiTech Store';
        $message = 'Hello, ' . $name . "\r\n" . 'This is a confirmation email of your purchase.' . "\r\n" . $bookInfo;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }
    
    public function getWholeShoppingCart($mid, $limit=3, $offset=0)
    {
        $data = $this->ShoppingCartModel->getWholeShoppingCart($mid, $limit, $offset);
        $this->load->view('shoppingCart/browseWhole', $data);
    }
    
}


?>