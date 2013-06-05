<?

class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
$this->load->library('upload');
        $this->load->model("template");
        $this->load->model("AnnouncementModel");
    }
    
    public function index()
    {
        $this->browse();
    }
    
    public function browse()
    {
        $data["annoucements"] = $this->AnnouncementModel->browseAnnouncement();
        $this->template->uCSliderBar("Annoucement/browse", $data);
    }
    
    public function create()
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	
        //這一行不加 $data 就沒辦法 new出來
    	$data['title'] = 'Create an announcement';
    	
    	$this->form_validation->set_rules('description', 'Description', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->uCSliderBar("Annoucement/create", $data);
    	}
    	else
    	{
    	    $d = $this->upload->data();
    	    $file_data = mysql_real_escape_string(file_get_contents($d['file_name']));
    		$this->AnnouncementModel->createAnnouncement($file_data);
    		$this->browse();
    	}
    }
}

?>