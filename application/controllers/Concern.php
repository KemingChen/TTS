<?
class Concern extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("ConcernModel");
        $this->load->model("MenuModel");
    }
    
    public function index()
    {
        //$this->concernBooks($memberID);
    }
    
    public function BrowseBooks($memberID,$offset=0,$selectNum=3)
    {
        $slideBarList = $this->MenuModel->getMemberList();
        $data = $this->ConcernModel->queryConcernBooks($memberID,$offset,$selectNum);
        $this->template->loadView("Member", $slideBarList, "Concern/browse", $data);
    }
    
    public function AddBook($memberID,$bid)
    {
        $this->ConcernModel->addBook($memberID,$bid);
        $this->BrowseBooks($memberID);
    }
    
    public function DeleteBook($memberID,$bid)
    {
        $this->ConcernModel->deleteBook($memberID,$bid);
        $this->BrowseBooks($memberID);
    }
}

?>