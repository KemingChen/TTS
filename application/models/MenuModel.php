<?php

class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
        $this->load->model("CategoryModel");
    }

    public function getHeaderList()
    {
        $isLogin = $this->authority->isLogin();
        $list = array();
        array_push($list, array("Url" => "View", "ID" => "Category", "Tag" =>
            "瀏覽書籍"));
        if ($isLogin) {
            array_push($list, array("Url" => "Nav/Member", "ID" => "Member", "Tag" => "會員專區"));
        } else {
            array_push($list, array("Url" => "Nav/NonMember", "ID" => "NonMember", "Tag" =>
                "取得帳號"));
        }
        return $list;
    }

    public function getCategoryList()
    {
        $query = $this->CategoryModel->getCategoryArray();
        $list = array();
        foreach ($query->result() as $category) {
            $list[$category->cid] = array("ID" => $category->cid, "Tag" => $category->name, "Url" => base_url().
                "View/Category/" . $category->cid);
        }
        return $list;
    }
    
    public function getNonMemberList(){
        $list = array();
        array_push($list, array("ID" => "NewMember", "Tag" => "加入會員'", "Url" => "NewMember"));
        array_push($list, array("ID" => "ForgotPassword", "Tag" => "忘記密碼", "Url" => "ForgotPassword"));
        return $list;
    }

    public function getMemberList()
    {
        $list = array();
        array_push($list, array("ID" => "Member", "Tag" => "會員資料", "Url" => ""));
        array_push($list, array("ID" => "Record", "Tag" => "交易紀錄", "Url" => ""));
        array_push($list, array("ID" => "Concern", "Tag" => "關注書單", "Url" => ""));
        array_push($list, array("ID" => "ShopCar", "Tag" => "購物車", "Url" => ""));
        array_push($list, array("ID" => "RePassword", "Tag" => "修改密碼", "Url" => ""));
        return $list;
    }
}
?>