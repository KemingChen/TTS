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
            $authority = $this->authority->getAuthority();
            if($authority=="manager"){
                array_push($list, array("Url" => "ViewReport", "ID" => "Manager", "Tag" => "經理"));
            }else if($authority=="administrator"){
                array_push($list, array("Url" => "AccountManagement", "ID" => "AccountManagement", "Tag" => "系統管理者"));
            }
        }
        else
        {
            array_push($list, array("Url" => "NewMember", "ID" => "NonMember", "Tag" =>
                "取得帳號"));
        }
        return $list;
    }
    
    public function getAnnouncementList()
    {
        $list = array();
        $list["Announcement"] = array("ID" => "AnnouncementList", "Tag" => "活動", "Url" =>
            "Announcement");
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
        $list["Transaction"] = array("ID" => "Transaction", "Tag" => "瀏覽購買清單", "Url" => "ViewMember/Me/Transaction");
        $list["Concern"] = array("ID" => "Concern", "Tag" => "關注書單", "Url" => "ViewMember/Me/Concern");
        $list["ShopCar"] = array("ID" => "ShopCar", "Tag" => "購物車", "Url" => "ViewMember/Me/ShopCar");
        $list["Password"] = array("ID" => "Password", "Tag" => "修改密碼", "Url" => "ViewMember/Me/Password");
        return $list;
    }

    public function getManagerList()
    {
        $list = array();
        $list["ViewReport"] = array("ID" => "ViewReport", "Tag" => "觀看報表", "Url" => "ViewReport");
        $list["TransactionRecords"] = array("ID" => "TransactionRecords", "Tag" => "瀏覽所有訂單", "Url" => "TransactionRecords");
        $list["TransactionCompleteRecords"] = array("ID" => "TransactionCompleteRecords", "Tag" => "瀏覽交易完成訂單", "Url" => "TransactionCompleteRecords");
        $list["OrderManagement"] = array("ID" => "OrderManagement", "Tag" => "管理未完成訂單", "Url" => "OrderManagement");
        $list["AnnouncementManagement"] = array("ID" => "AnnouncementManagement", "Tag" => "管理活動", "Url" => "AnnouncementManagement");
        //$list["AddAnnouncement"] = array("ID" => "AddAnnouncement", "Tag" => "新增活動", "Url" => "AddAnnouncement");
        $list["DiscountManagement"] = array("ID" => "DiscountManagement", "Tag" => "管理折扣活動", "Url" => "DiscountManagement");
        $list["RebateManagement"] = array("ID" => "RebateManagement", "Tag" => "管理減價活動", "Url" => "RebateManagement");
        $list["Ecoupon"] = array("ID" => "Ecoupon", "Tag" => "發送ECoupon", "Url" => "ViewEcoupon");
        $list["AddBook"] = array("ID" => "AddBook", "Tag" => "新增書籍", "Url" => "AddBook");
        $list["StockBrowse"] = array("ID" => "StockBrowse", "Tag" => "觀看庫存", "Url" => "StockBrowse");
        $list["Stock"] = array("ID" => "Stock", "Tag" => "管理庫存", "Url" => "Stock");
        $list["OnShelf"] = array("ID" => "OnShelf", "Tag" => "上架", "Url" => "OnShelf");
        $list["OffShelf"] = array("ID" => "OffShelf", "Tag" => "下架", "Url" => "OffShelf");
        return $list;        
    }

    public function getAdministratorList()
    {
        $list = array();
        $list["AccountManagement"] = array("ID" => "AccountManagement", "Tag" => "管理帳號", "Url" => "AccountManagement");
        $list["NewMemberAdmin"] = array("ID" => "NewMemberAdmin", "Tag" => "新增會員", "Url" => "NewMemberAdmin");
        return $list;
    }
}


?>