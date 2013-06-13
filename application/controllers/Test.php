<?php

class Test extends CI_Controller
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
    
    public function test($p1="a", $p2="b", $p3="c"){
        echo "p1=$p1<br />";
        echo "p2=$p2<br />";
        echo "p3=$p3<br />";
        
    }
}


?>