<?php

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ReportModel");
        $this->load->model("template");
        $this->load->library('pagination');
        $this->load->model("MenuModel");
        //�W���ɮ׭n�Ϊ�
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
    	$this->load->library('form_validation');
        $this->load->model("authority");
    }
    
    public function index($offset = 0)
    {
        $this->page($offset);
    }
    
    public function page($offset = 0)
    {
        $config['base_url'] = base_url('Report/page');
        //$config['total_rows'] = $this->BookModel->getOnShelfAmount();
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['num_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] =
            $config['first_tag_open'] = $config['last_tag_open'] = '<li>';
        $config['num_tag_close'] = $config['prev_tag_close'] = $config['next_tag_close'] =
            $config['first_tag_close'] = $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li = class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a>";
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);


        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["Report"]['Active'] = "active";
        $content = "ReportView";
        $result = $this->ReportModel->bookSellReport();
        $data["list"] = $result["report"];
        $data["pagination"] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, $content, $data);
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
    
    public function browseDateTurnoverByDate($date)
    {
        $data['turnover'] = $this->ReportModel->getTurnoverByDate($date);
        $this->load->view('Report/browseTurnover', $data);
    }
    
    public function browseMonthTurnoverByYearAndMonth($year, $month)
    {
        $data['turnover'] = $this->ReportModel->getTurnoverByYearAndMonth($year, $month);
        $this->load->view('Report/browseTurnover', $data);
    }
    
    public function browseYearTurnoverByYear($year)
    {
        $data['turnover'] = $this->ReportModel->getTurnoverByYear($year);
        $this->load->view('Report/browseTurnover', $data);
    }
    ////////////////////////////////////////////
    public function browseDateProfitByDate($date)
    {
        $data['profit'] = $this->ReportModel->getProfitByDate($date);
        $this->load->view('Report/browseProfit', $data);
    }
    
    public function browseMonthProfitByYearAndMonth($year, $month)
    {
        $data['profit'] = $this->ReportModel->getProfitByYearAndMonth($year, $month);
        $this->load->view('Report/browseProfit', $data);
    }
    
    public function browseYearProfitByYear($year)
    {
        $data['profit'] = $this->ReportModel->getProfitByYear($year);
        $this->load->view('Report/browseProfit', $data);
    }
    ////////////////////////////////////////////////
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
    
    public function getOrderQuantityByRebateEvent()
    {
        $data["report"] = $this->ReportModel->getOrderQuantityByRebateEvent();
        
        //$this->load->view('Report/browsePriceAdvice', $data);
    }
    
    public function eCouponUtility()
    {
        $data["report"] = $this->ReportModel->eCouponUtility();
        //$this->load->view('Report/browsePriceAdvice', $data);
    }
}