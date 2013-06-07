<?
class Author extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("AuthorModel");
    }
    
    public function index()
    {
        $this->ListAll();
    }
    
    public function ListAll($offset=0,$selectNum=5)
    {
        $data = $this->AuthorModel->ListAuthors($offset,$selectNum);
        $this->template->view("", "", "Author/list", $data);
    }
    
    public function Browse($pid)
    {
        $data = $this->AuthorModel->Browse($pid);
        $this->template->view("", "", "Author/browse", $data);
    }
    
    public function Create($name,$introduction=null)
    {
        $name = urldecode($name);
        $introduction = urldecode($introduction);
        $data = array(
           'name'    => $name,
           'introduction' => $introduction
        );
        $this->AuthorModel->create($data);
        $this->ListAll();
    }
    
    public function Update($aid,$name,$introduction=null)
    {
        $name = urldecode($name);
        $introduction = urldecode($introduction);
        $data = array(
           'name'    => $name,
           'introduction' => $introduction
        );
        $this->AuthorModel->update($aid,$data);
        $this->ListAll();
    }
    
    public function Delete($pid)
    {
        $this->PublisherModel->delete($pid);
        $this->ListAll();
    }
}

?>