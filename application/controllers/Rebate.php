<?php

class Rebate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("RebateModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function rebateSize()
    {
        $data = $this->RebateModel->browseSize();
        //print_r($data->num_rows());
        //exit;
        //$this->load->view("Discount/browse", $data);
    }
    
    public function browseAll($offset = 0, $limit = 9999)
    {
        $data['rebate'] = $this->RebateModel->browse($offset, $limit);
        $this->load->view("Rebate/browse", $data);
    }
    
    public function browseOne($reid)
    {
        $data['rebate'] = $this->RebateModel->browseOne($reid);
        $this->load->view("Rebate/browse", $data);
    }
    
    public function insertRebate($name, $startTime, $endTime, $threshold, $price)
    {
        $name = urldecode($name);
        $this->RebateModel->insertRebate($name, $startTime, $endTime, $threshold, $price);
        $data["rebate"] = $this->RebateModel->browse(0,9999);
        $this->load->view('Rebate/browse', $data);
    }
    
    public function updateRebate($reid, $startTime, $endTime)
    {
        $this->RebateModel->updateRebate($reid, $startTime, $endTime);
        $data["rebate"] = $this->RebateModel->browse(0, 9999);
        $this->load->view('Rebate/browse', $data);
    }
}
?>