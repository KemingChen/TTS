<?php

class ECoupon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ECouponModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
    }
    
    public function ECouponSize()
    {
        $data = $this->ECouponModel->browseSize();
        //print_r($data->num_rows());
        //exit;
        //$this->load->view("Discount/browse", $data);
    }
    
    public function browseAll($offset = 0, $limit = 9999)
    {
        $data['ecoupon'] = $this->ECouponModel->browse($offset, $limit);
        $this->load->view("Ecoupon/browse", $data);
    }
    
    public function browseOne($ecid)
    {
        $data['ecoupon'] = $this->ECouponModel->browseOne($ecid);
        $this->load->view("Ecoupon/browse", $data);
    }
    
    public function insertECoupon($couponCode, $startTime, $endTime, $price)
    {
        //$name = urldecode($name);
        $this->ECouponModel->insertECoupon($couponCode, $startTime, $endTime, $price);
        $data["ecoupon"] = $this->ECouponModel->browse(0, 9999);
        $this->load->view('Ecoupon/browse', $data);
    }
    
    public function updateECoupon($ecid, $startTime, $endTime)
    {
        $this->ECouponModel->updateECoupon($ecid, $startTime, $endTime);
        $data["ecoupon"] = $this->ECouponModel->browse(0, 9999);
        $this->load->view('Ecoupon/browse', $data);
    }
}
?>