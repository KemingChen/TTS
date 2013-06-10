<?php

class Template extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("authority");
        $this->load->model("MenuModel");
        //$this->load->model("TransactionModel");
        //$this->load->library("session");
    }

    public function loadView($headerActiveID, $slideBarList, $content, $contentData)
    {
        $this->loadHeader($headerActiveID);
        $this->loadSlideBarContent($slideBarList, $content, $contentData);
        $this->loadFooter();
    }

    private function loadHeader($activeID)
    {
        $isLogin = $this->authority->isLogin();
        $list = $this->MenuModel->getHeaderList();
        $this->updateActive($list, $activeID);
        $data = array('list' => $list);
        $data["isLogin"] = $isLogin;
        $data["username"] = $this->authority->getName();
        $this->load->view("include/header", $data);
    }

    private function updateActive(&$data, $activeID)
    {
        foreach ($data as & $item) {
            $item["Active"] = $item["ID"] == $activeID ? "active" : "";
        }
    }

    private function loadSlideBarContent($slideBarList, $content, $contentData)
    {
        $slideBarData = array('list' => $slideBarList);
        $this->load->view("include/slideBarContentHeader", $slideBarData);
        $this->load->view($content, $contentData);
        $this->load->view("include/slideBarContentFooter");
    }

    private function loadFooter()
    {
        $this->load->view('include/Footer');

    }
}

?>