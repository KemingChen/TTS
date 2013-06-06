<?php

class Template extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("authority");
    }

    public function view($activeID, $sliderBarName, $pageName, $data)
    {
        $header = $this->getHeader($sliderBarName);
        $sliderBar = $this->getSliderBar($activeID, $sliderBarName);
        $this->uSliderBar($header, $sliderBar, $pageName, $data);
    }

    private function getHeader($activeID)
    {
        $this->load->model("CategoryModel");
        $header = array();
        array_push($header, array("ID" => "Category", "Tag" => "瀏覽書籍"));
        array_push($header, array("ID" => "Member", "Tag" => "會員專區"));
        $this->setUrl($header);
        $this->setActive($activeID, $header);

        $info["isLogin"] = $this->authority->isLogin();
        $info["header"] = $header;
        return $info;
    }

    private function getSliderBar($activeID, $sliderBarName)
    {
        $sliderBar = array();
        switch ($sliderBarName)
        {
            case "Category":
                $cData = $this->CategoryModel->getCategoryArray();
                foreach($cData->result() as $category)
                {
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
                $this->setUrl($sliderBar);
                break;
        }
        $this->setActive($activeID, $sliderBar);
        return $sliderBar;
    }

    private function setActive($activeID, &$data)
    {
        foreach ($data as & $item)
        {
            $item["Active"] = $item["ID"] == $activeID ? "active" : "";
        }
    }

    private function setUrl(&$array, $baseUrl = "")
    {
        foreach ($array as & $item)
        {
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