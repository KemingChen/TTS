<?
class Concern extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("ConcernModel");
    }
    
    public function index()
    {
        //$this->concernBooks($memberID);
    }
    
    public function concernBooks($memberID)
    {
        $data = $this->ConcernModel->queryConcernBooks($memberID);
        $this->template->view("", "", "Concern/browse", $data);
    }
}

?>