<?php

class Template extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("authority");
        $this->load->model("TransactionModel");
        $this->load->library("session");
    }

    public function view($activeID, $sliderBarName, $pageName, $data = array())
    {
        static $canShow = true;
        if ($canShow) {
            $header = $this->getHeader($sliderBarName);
            $sliderBar = $this->getSliderBar($activeID, $sliderBarName);
            $this->uSliderBar($header, $sliderBar, $pageName, $data);
        }
        $canShow = false;
    }

    private function getHeader($activeID)
    {
        $isLogin = $this->authority->isLogin();
        
        $header = array();
        array_push($header, array("ID" => "Category", "Tag" => "瀏覽書籍"));
        if ($isLogin)
            array_push($header, array("ID" => "Member", "Tag" => "會員專區"));
        else
            array_push($header, array("ID" => "NonMember", "Tag" => "取得帳號"));
        $this->setUrl($header);
        $this->setActive($activeID, $header);

        $info["isLogin"] = $isLogin;
        $info["header"] = $header;
        $info["username"] = $this->authority->getName();
        return $info;
    }

    private function getSliderBar($activeID, $sliderBarName)
    {
        $sliderBar = array();
        switch ($sliderBarName) {
            case "Category":
                $this->load->model("CategoryModel");
                $cData = $this->CategoryModel->getCategoryArray();
                foreach ($cData->result() as $category) {
                    array_push($sliderBar, array("ID" => $category->cid, "Tag" => $category->name));
                }
                $this->setUrl($sliderBar, "Category/");
                break;

            case "Member":
                array_push($sliderBar, array("ID" => "Member", "Tag" => "會員資料"));
                array_push($sliderBar, array("ID" => "Record", "Tag" => "交易紀錄"));
                array_push($sliderBar, array("ID" => "Concern", "Tag" => "關注書單"));
                array_push($sliderBar, array("ID" => "ShopCar", "Tag" => "購物車"));
                array_push($sliderBar, array("ID" => "RePassword", "Tag" => "修改密碼"));
                $this->setUrl($sliderBar, "Member/");
                break;
            case "NonMember":
                array_push($sliderBar, array("ID" => "NewMember", "Tag" => "加入會員"));
                array_push($sliderBar, array("ID" => "ForgotPassword", "Tag" => "忘記密碼"));
                $this->setUrl($sliderBar, "NonMember/");
        }
        $this->setActive($activeID, $sliderBar);
        return $sliderBar;
    }
    
    private function setActive($activeID, &$data)
    {
        foreach ($data as & $item) {
            $item["Active"] = $item["ID"] == $activeID ? "active" : "";
        }
    }

    private function setUrl(&$array, $baseUrl = "")
    {
        foreach ($array as & $item) {
            $item["Url"] = base_url() . "Nav/" . $baseUrl . $item["ID"];
        }
    }

    private function uSliderBar($header, $sliderBar, $pageName, $data)
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;
        $info["menu"] = $sliderBar;
        if ($pageName == "ShopCarView") {
            $info["list"] = array();
            array_push($info["list"], array("ISBN" => "9789570410976", "Name" =>
                "初學者的料理教科書：2500張步驟圖解，新手必備史上最簡單！看這本，保證不失敗！", "Quantity" => "2", "Price" => "480"));
            array_push($info["list"], array("ISBN" => "9572884301", "Name" =>
                "飼養烏龜必知的68項小常識", "Quantity" => "1", "Price" => "220"));
            array_push($info["list"], array("ISBN" => "9789862282359", "Name" =>
                "輕輕鬆鬆養烏龜：68個飼養小常識", "Quantity" => "2", "Price" => "440"));
        } else if ($pageName == "ConcernView") {
                $info["list"] = array();
                array_push($info["list"], array("ISBN" => "9789570410976", "Name" =>
                    "初學者的料理教科書：2500張步驟圖解，新手必備史上最簡單！看這本，保證不失敗！", "Price" => "480"));
                array_push($info["list"], array("ISBN" => "9572884301", "Name" =>
                    "飼養烏龜必知的68項小常識", "Price" => "220"));
                array_push($info["list"], array("ISBN" => "9789862282359", "Name" =>
                    "輕輕鬆鬆養烏龜：68個飼養小常識", "Price" => "440"));
        }else if($pageName == "Account/BrowserAccountView"){
            $info["email"] = $this->authority->getEmail();//"housemeow@yahoo.com.tw";
            $info["name"] = $this->authority->getName();
            $info["birthDate"] = $this->authority->getBirthDate();
            $info["zipCode"] = $this->authority->getZipCode();
            $info["address"] = $this->authority->getAddress();
        }
        else if($pageName=="RecordView"){
            $info['list'] = $this->TransactionModel->browseTransactionRecords();
        }

        $this->load->view('include/Header', $header);
        $this->load->view("include/SliderBar", $info, $return);
        $this->load->view('include/Footer');
    }

    private function debug($array)
    {
        print_r($array);
        exit;
    }
}

?>