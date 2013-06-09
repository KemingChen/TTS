<?php

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("StockModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function browseBooksStock($offset=0,$limit=10)
    {
        $data = $this->StockModel->browseBooksStock($limit,$offset);
        $this->load->view('Stock/browseBooksStock', $data);
    }
    
    public function browseStockRecord($offset=0,$limit=10)
    {
        $data = $this->StockModel->browseStockRecord($limit,$offset);
        $this->load->view('Stock/browseStockRecord', $data);
    }
    
    public function addStockRecord($bid, $price, $amount, $restAmount, $stockTime)
    {
        $this->StockModel->addStockRecord($bid, $price, $amount, $restAmount, $stockTime);
        echo 'OK';
    }    
}


?>