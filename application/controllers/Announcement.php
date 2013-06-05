<?

class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("AnnouncementModel");
        //�W���ɮ׭n�Ϊ�
        $this->load->helper(array('form','url'));
        $this->load->library('upload');
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
    	
        //�o�@�椣�[ �N�S��k new data�X��
    	$data['title'] = 'Create an announcement';
    	
    	$this->form_validation->set_rules('description', 'Description', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->uCSliderBar("Annoucement/create", $data);
    	}
    	else
    	{
    	    //���ˬdupload������  �p�G�q�L�A�W��
        	if ( ! $this->upload->do_upload('picture'))
    		{
    			$error = array('error' => $this->upload->display_errors());
                $this->template->uCSliderBar("Annoucement/create", $error);
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
        		$this->AnnouncementModel->createAnnouncement($file_data);
        		$this->browse();
    		}
    	}
    }
}

?>