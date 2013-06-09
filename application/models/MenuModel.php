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
        array_push($list, array("Url" => "View", "ID" => "Category", "Tag" => "瀏覽書籍"));
        if ($isLogin)
        {
            array_push($list, array("Url" => "ViewMember", "ID" => "Member", "Tag" => "會員專區"));
        }
        else
        {
            array_push($list, array("Url" => "NewMember", "ID" => "NonMember", "Tag" =>
                "取得帳號"));
        }
        return $list;
    }

    public function getCategoryList()
    {
        $query = $this->CategoryModel->getCategoryArray();
        $list = array();
        foreach ($query->result() as $category)
        {
            $list[$category->cid] = array("ID" => $category->cid, "Tag" => $category->name,
                "Url" => "View/Category/" . $category->cid);
        }
        return $list;
    }

    public function getNonMemberList()
    {
        $list = array();
        $list["NewMember"] = array("ID" => "NewMember", "Tag" => "加入會員", "Url" =>
            "NewMember");
        $list["ForgotPassword"] = array("ID" => "ForgotPassword", "Tag" => "忘記密碼", "Url" =>
            "ForgotPassword");
        return $list;
    }

    public function getMemberList()
    {
        $list = array();
        $list["Info"] = array("ID" => "Info", "Tag" => "會員資料", "Url" => "ViewMember/Me/Info");
        $list["Transaction"] = array("ID" => "Transaction", "Tag" => "交易紀錄", "Url" => "ViewMember/Me/Transaction");
        $list["Concern"] = array("ID" => "Concern", "Tag" => "關注書單", "Url" => "ViewMember/Me/Concern");
        $list["ShopCar"] = array("ID" => "ShopCar", "Tag" => "購物車", "Url" => "ViewMember/Me/ShopCar");
        $list["Password"] = array("ID" => "Password", "Tag" => "修改密碼", "Url" => "ViewMember/Me/Password");
        return $list;
    }
}

?>