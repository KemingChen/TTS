<?php

class MemberModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model("GmailModel");
        $this->load->model("AccountModel");
        $this->load->model("AnnouncementModel");
        $this->load->model("BrowseModel");
        $this->load->model("authority");
    }

    public function index()
    {
        //echo "hello member";
    }

    public function register()
    {
        $accountData = array('email' => $this->input->post('email'), 'password' => $this->
            input->post('password'), 'zipCode' => $this->input->post('zipCode'), 'birthday' =>
            $this->input->post('birthday'), 'address' => $this->input->post('address'),
            'available' => 0, 'name' => $this->input->post('name'));
        $this->db->insert('Account', $accountData);
        $email = $accountData['email'];
        $mid = $this->AccountModel->getMidByEmail($email);
        $name = $accountData['name'];
        $phoneData = array('mid' => $mid, 'phoneNumber' => $this->input->post('phoneNumber'));
        $this->db->insert('cellphonenumbercorrespond', $phoneData);
        $this->sendVerificationMail($email, $mid, $name);
        return $email;
    }

    public function updateInfo($mid, $name, $birthday, $zipCode, $address)
    {
        $data = array('name' => $name, 'birthday' => $birthday, 'zipCode' => $zipCode, 'address' => $address);
        $this->db->where('mid', $mid);
        $this->db->update('account', $data);

    }

    public function sendVerificationMail($email = "", $mid, $name)
    {
        $recipient = $email;
        $subject = 'TaipeiTech Store';
        $name = $name;
        // local link
        // $link = 'http://localhost/TTS/Member/verificate/' . $mid;
        // online link
        $link = 'http://islab1221.twbbs.org:1221/TTS/Member/verificate/'.$mid;
        $message = "親愛的$name" . "您好," . "\r\n" . '您的帳號已經註冊成功!.' . "\r\n\r\n" .
            '請點擊連結開通您的帳戶:' . "\r\n" . $link;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }

    public function verificate($mid)
    {
        $authoriy = $this->getAuthorityByMid($mid);
        if ($authoriy === null) {
            $this->AccountModel->unfreeze($mid);
            $this->AccountModel->modifyAuthority($mid, 'customer');
        }
    }

    public function addPhone($mid, $phone)
    {
        $data = array('mid' => $mid, 'phoneNumber' => $phone);
        $this->db->insert('cellphonenumbercorrespond', $data);
    }

    public function modifyPhone($mid, $phone, $newPhone)
    {
        $newData = array('phoneNumber' => $newPhone);
        $this->db->where('mid', $mid);
        $this->db->where('phoneNumber', $phone);
        $this->db->update('cellphonenumbercorrespond', $newData);
    }

    public function modifyMemberInfo()
    {
        $data = array('email' => $this->input->post('email'), 'zipCode' => $this->input->
            post('zipCode'), 'birthday' => $this->input->post('birthday'), 'address' => $this->
            input->post('address'), 'name' => $this->input->post('name'));
        $email = $data['email'];
        $this->db->where('email', $email);
        $this->db->update('Account', $data);
        return $email;
    }

    public function modifyMemberPassword()
    {
        $data = array('email' => $this->input->post('email'), 'password' => $this->
            input->post('password'), 'newPassword' => $this->input->post('newPassword'));
        $email = $data['email'];
        $password = $data['password'];
        $newPassword = $data['newPassword'];
        $newData = array('password' => $newPassword);
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->update('Account', $newData);
    }

    public function revisePassword($password)
    {
        $mid = $this->authority->getMemberID();
        $this->db->where('mid', $mid);
        $this->db->update('Account', array("password"=> $password));
    }

    public function getMemberInfoByEmailFromView()
    {
        $emailData = array('email' => $this->input->post('email'), );
        $email = $emailData['email'];
        $this->db->select('email, zipCode, birthday, address, name');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }

    public function getMemberInfoByEmail($email)
    {
        $this->db->select('email, zipCode, birthday, address, name');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }

    public function getAuthorityByMid($mid)
    {
        $this->db->select('authority');
        $this->db->from('account');
        $this->db->where('mid', $mid);
        $dataResult = $this->db->get()->result();
        $authority = $dataResult[0]->authority;
        return $authority;
    }

    public function getPasswordByEmail($email)
    {
        $this->db->select('name, password');
        $this->db->from('account');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }

    public function forgetPassword($email = "")
    {
        $recipient = $email;
        $subject = 'TaipeiTech Store';
        $data = $this->MemberModel->getPasswordByEmail($recipient);
        $result = $data->result();
        $password = $result[0]->password;
        $name = $result[0]->name;
        $message = "親愛的$name" ."您好,"  . "\r\n" . '您的密碼是:' . $password;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }
}
?>