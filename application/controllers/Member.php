<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("MemberModel");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->model("template");
    }
    
    public function index(){
        echo "hello member";
    }
    
    public function register()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('phoneNumber', 'phoneNumber', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/Register", array());
    	}
    	else
    	{
            $email = $this->MemberModel->register();
            $data['account'] = $this->MemberModel->getMemberInfoByEmail($email);
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function verificate($mid)
    {
        $this->MemberModel->verificate($mid);
        $this->browseIndex();
    }
    
    public function browseIndex()
    {
        $data = $this->getData();
        $this->template->loadView("Announcement", null, "AnnoucementView", $data);
    }
    
    public function getData()
    {
        $temp = $this->BrowseModel->GetLatestBook(0, 5,false);
        $data["latestPublishList"] = $temp['books'];
        $temp = $this->BrowseModel->GetHotRankingBook(0, 5,false);
        $data["hotRankingList"] = $temp['books'];
        $temp = $this->BrowseModel->GetMostConcernedBook(0, 5,false);
        $data["mostConcernedList"] = $temp['books'];
        $categoryList = $this->CategoryModel->getCategoryList();
        $categoryIndex = rand(0, count($categoryList)-1);
        $categoryID = $categoryList[$categoryIndex]->cid;
        $categoryName = $categoryList[$categoryIndex]->name;
        $data['categoryName'] = $categoryName;
        $temp = $this->BrowseModel->GetBookByCategory($categoryID, 0, 5,false);
        $data["categoryBookList"] = $temp['books'];
        $data['size'] = $this->AnnouncementModel->getAnnouncementSize();
        $data["list"] = $this->AnnouncementModel->getAnnouncementList();
        return $data;
    }
    
    public function addPhone($mid, $phone)
    {
        $this->MemberModel->addPhone($mid, $phone);
    }
    
    public function sendVerificationMail($email="", $mid=0, $name=""){
        $this->MemberModel->sendVerificationMail("j99590314@gmail.com", 93, "ffew");
    }
    
    public function modifyPhone($mid, $phone, $newPhone)
    {
        $this->MemberModel->modifyPhone($mid, $phone, $newPhone);
    }
    
    public function modifyMemberInfo()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ModifyMemberInformation", array());
    	}
    	else
    	{
            $email = $this->MemberModel->modifyMemberInfo();
            $data['account'] = $this->MemberModel->getMemberInfoByEmail($email);
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function modifyMemberPassword()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('newPassword', 'newPassword', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ModifyMemberPassword", array());
    	}
    	else
    	{
            $email = $this->MemberModel->modifyMemberPassword();
    	}
    }
    
    public function forgetPassword()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/ForgetPassword", array());
    	}
    	else
    	{
            $email = $this->input->post('email');
            $this->MemberModel->forgetPassword($email);
    	}
    }
    
    public function browseMemberInfo()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->load->view("Member/BrowseMemberInfo", array());
    	}
    	else
    	{
            $data['account'] = $this->MemberModel->getMemberInfoByEmailFromView();
            $this->load->view("Member/BrowseMemberInfoResult", $data);
    	}
    }
    
    public function browsePhoneByMid($mid)
    {
        $data['phone'] = $this->AccountModel->browsePhoneByMid($mid);
        if($data['phone']->num_rows() > 0)
        {
            $this->load->view('Account/BrowsePhoneByMid', $data);
        }
        else
        {
            show_error("no data");
        }
    }
}

?>