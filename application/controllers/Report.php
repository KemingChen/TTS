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
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("authority");
    }


    public function bookSellReport()
    {
        $data = $this->ReportModel->bookSellReport();
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Profit", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->name, "f" => null),
                array("v" => (int)$row->profit, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }

    public function publisherSellReport()
    {
        $data = $this->ReportModel->publisherSellReport();
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Profit", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->name, "f" => null),
                array("v" => (int)$row->profit, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
        
        //$this->load->view('Report/browseCategorySell', $data);
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
    
    public function broweseEveryMonthTurnoverByYear($year)
    {
        $data = $this->ReportModel->getEveryMonthTurnoverByYear($year);
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "Month", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Turnover", "pattern" => "",
            "type" => "number"));
            
        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->month, "f" => null),
                array("v" => (int)$row->turnover, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }
    
    public function browseEveryDayTurnoverByMonth($year, $month)
    {
        $data = $this->ReportModel->getEveryDayTurnoverByYearAndMonth($year, $month);
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "Date", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Turnover", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->date, "f" => null),
                array("v" => (int)$row->turnover, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }
    
    public function browseEveryDayBookTurnoverByDate($date)
    {
        $data = $this->ReportModel->getBookTurnoverByDate($date);
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Turnover", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->name, "f" => null),
                array("v" => (int)$row->turnover, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }
    ////////////////////////////////////////////////
    public function authorSellReport()
    {
        $data["report"] = $this->ReportModel->authorSellReport();
        $this->load->view('Report/browseAuthorSell', $data);
    }

    public function revenueFromPromotionalActivities()
    {
        $data = $this->ReportModel->revenueFromPromotionalActivities();
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "TotalPrice", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->name, "f" => null),
                array("v" => (int)$row->total_price, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
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
        $unUsed = $this->ReportModel->eCouponUnUsedAmount();
        $used = $this->ReportModel->eCouponUsedAmount();
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "TotalPrice", "pattern" => "",
            "type" => "number"));

        foreach ($unUsed['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => "UnUsedAmount", "f" => null),
                array("v" => (int)$row->count, "f" => null))));
        }
        foreach ($used['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => "UsedAmount", "f" => null),
                array("v" => (int)$row->count, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
        //$this->load->view('Report/browsePriceAdvice', $data);
    }
    
    public function rebateSellReport()
    {
        $data = $this->ReportModel->getRebateEventReport();
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "RebateName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Trunover", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->name, "f" => null),
                array("v" => (int)$row->turnover, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }
    
    public function linear($isbn)
    {
        $data = $this->ReportModel->getDiscountAnalysisByIsbn($isbn);
        $list = array("cols" => array(), "rows" => array());
        
        array_push($list["cols"], array("id" => "", "label" => "BookName", "pattern" =>
            "", "type" => "string"));
        array_push($list["cols"], array("id" => "", "label" => "Profit", "pattern" => "",
            "type" => "number"));

        foreach ($data['report'] as $row) {
            array_push($list["rows"], array("c" => array(array("v" => $row->dName, "f" => null),
                array("v" => (int)$row->profit, "f" => null))));
        }
        $json = json_encode($list);
        echo $json;
    }
    
    public function linearBookName($isbn)
    {
        $data = $this->ReportModel->getDiscountAnalysisByIsbn($isbn);
        $return = $data['report']->bName;
        //echo "hff";
        echo $return;
    }
    
    public function test()
    {
        $isbn = '9789570410976';
        $data['result'] = $this->ReportModel->getDiscountAnalysisByIsbn($isbn);
        $this->load->view('test', $data);
    }
}
