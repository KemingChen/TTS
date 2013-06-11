<?php

class Discount extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("DiscountModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function discountSize()
    {
        $data = $this->DiscountModel->browseSize();
        //print_r($data->num_rows());
        //exit;
        //$this->load->view("Discount/browse", $data);
    }
    
    public function browseAll($offset = 0, $limit = 9999)
    {
        $data['discount'] = $this->DiscountModel->browse($offset, $limit);
        $this->load->view("Discount/browse", $data);
    }
    
    public function browseOne($deid)
    {
        $data['discount'] = $this->DiscountModel->browseOne($deid);
        $this->load->view("Discount/browse", $data);
    }
    
    public function insertDiscount($cid, $name, $startTime, $endTime, $discount_rate)
    {
        $name = urldecode($name);
        $this->DiscountModel->insertDiscount($cid, $name, $startTime, $endTime, $discount_rate);
        $data["discount"] = $this->DiscountModel->browse(0, 9999);
        $this->load->view('Discount/browse', $data);
    }
    
    public function updateDiscount($deid, $startTime, $endTime)
    {
        $this->DiscountModel->updateDiscount($deid, $startTime, $endTime);
        $data["discount"] = $this->DiscountModel->browse(0, 9999);
        $this->load->view('Discount/browse', $data);
    }
}
?>