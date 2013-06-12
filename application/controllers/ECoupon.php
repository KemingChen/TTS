<?php

class ECoupon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ECouponModel");
        $this->load->model("GmailModel");
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
    
    public function insertECoupon($quantity = 1, $startTime, $endTime, $price)
    {
        //$name = urldecode($name);
        $couponCode = $this->ECouponModel->generateCouponCode();
        $this->ECouponModel->insertECoupon($quantity, $startTime, $endTime, $price);
        $data["ecoupon"] = $this->ECouponModel->browse(0, 9999);
        $this->load->view('Ecoupon/browse', $data);
    }
    
    public function updateECoupon($ecid, $startTime, $endTime)
    {
        $this->ECouponModel->updateECoupon($ecid, $startTime, $endTime);
        $data["ecoupon"] = $this->ECouponModel->browse(0, 9999);
        $this->load->view('Ecoupon/browse', $data);
    }
    
    public function release($mid, $ecid)
    {
        $info = $this->ECouponModel->getCustomerInformation($mid);
        $data["ecoupon"] = $this->ECouponModel->emailContent($ecid);
        $couponInfo = '';
        foreach ($data["ecoupon"]->result() as $row)
        {
            $couponCode = $row->couponCode;
            $startTime = $row->startTime;
            $endTime = $row->endTime;
            $couponInfo = $couponInfo . 'couponCode: ' . $couponCode . '  startTime: ' . $startTime . '  endTime: ' . $endTime . "\r\n";
        }
        foreach ($info->result() as $row)
        {
            $recipient =  $row->email;
            $name = $row->name;
        }
        $subject = 'TaipeiTech Store';
        $message = 'Hello, ' . $name . "\r\n" . 'Here is a coupon fou YOU!! Have a good time!.' . "\r\n" . $couponInfo;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }
}
?>