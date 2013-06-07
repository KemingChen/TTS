<?
class Publisher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("PublisherModel");
    }
    
    public function index()
    {
        $this->ListAll();
    }
    
    public function ListAll($offset=0,$selectNum=5)
    {
        $data = $this->PublisherModel->ListPublishers($offset,$selectNum);
        $this->template->view("", "", "Publisher/list", $data);
    }
    
    public function Browse($pid)
    {
        $data = $this->PublisherModel->Browse($pid);
        $this->template->view("", "", "Publisher/browse", $data);
    }
    
    public function Create($name,$address=null,$phone=null,$webSite = null)
    {
        $name = urldecode($name);
        $data = array(
           'name'    => $name,
           'address' => $address,
           'phone'   => $phone,
           'webSite' => $webSite
        );
        $this->PublisherModel->create($data);
        $this->ListAll();
    }
    
    public function Update($pid,$name,$address=null,$phone=null,$webSite = null)
    {
        $pid = urldecode($pid);
        $name = urldecode($name);
        $data = array(
            'name'      => $name,
            'address'   => $address,
            'phone'     => $phone,
            'webSite'   => $webSite
        );
        $this->PublisherModel->update($pid,$data);
        $this->ListAll();
    }
    
    public function Delete($pid)
    {
        $this->PublisherModel->delete($pid);
        $this->ListAll();
    }
}

?>