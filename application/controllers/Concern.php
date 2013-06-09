<?

class Concern extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("authority");
        $this->load->model("ConcernModel");
    }

    public function Add($bid)
    {
        $mid = $this->authority->getMemberID();
        $this->ConcernModel->addBook($mid, $bid);
        echo "OK";
    }

    public function Remove($bid)
    {
        $mid = $this->authority->getMemberID();
        $this->ConcernModel->deleteBook($mid, $bid);
        echo "OK";
    }
}

?>