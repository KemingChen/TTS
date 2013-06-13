<?php

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ReportModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
        $this->load->model("authority");
    }
    
    public function bookSellReport()
    {
        $data["report"] = $this->ReportModel->bookSellReport();
        $this->load->view('Report/browseBookSell', $data);
    }
    
    public function categorySellReport()
    {
        $data["report"] = $this->ReportModel->categorySellReport();
        $this->load->view('Report/browseCategorySell', $data);
    }
    
    public function browseTurnover($year, $month)
    {
        $turnover = $this->ReportModel->getTurnoverByYearAndMonth($year, $month);
        $this->load->view('Report/browseTurnover', $turnover);
    }
    
    public function authorSellReport()
    {
        $data["report"] = $this->ReportModel->authorSellReport();
        $this->load->view('Report/browseAuthorSell', $data);
    }
    
    public function revenueFromPromotionalActivities()
    {
        $data["report"] = $this->ReportModel->revenueFromPromotionalActivities();
        $this->load->view('Report/browseRevenue', $data);
    }
    
    public function priceAdvice()
    {
        $data["report"] = $this->ReportModel->priceAdvice();
        $this->load->view('Report/browsePriceAdvice', $data);
    }
}