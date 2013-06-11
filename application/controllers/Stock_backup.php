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
    
    public function browseBooksStock()
    {
        $data["records"] = $this->StockModel->browseBooksStock();
        $this->load->view('Stock/browseBooksStock', $data);
    }
    
    public function browseStockRecord()
    {
        $data["records"] = $this->StockModel->browseStockRecord();
        $this->load->view('Stock/browseStockRecord', $data);
    }
    
    public function addStockRecord($bid, $price, $amount)
    {
        //$this->form_validation->set_rules('bid', 'bid', 'required');
    	
    	//if ($this->form_validation->run() === FALSE)
    	//{
            //$this->load->library('../controllers/Nav');
            //$this->load->view("Stock/Add", array());
    	//}
    	//else
    	//{
            $this->StockModel->addStockRecord($bid, $price, $amount);
            $data["records"] = $this->StockModel->browseStockRecord();
            //$this->load->view('stock/browseStockRecord', $data);
    	//}
    }    
}


?>