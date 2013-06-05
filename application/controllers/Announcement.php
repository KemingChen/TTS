<?

class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("AnnouncementModel");
        //上傳檔案要用的
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
    	
        //這一行不加 就沒辦法 new data出來
    	$data['title'] = 'Create an announcement';
    	
    	$this->form_validation->set_rules('description', 'Description', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->uCSliderBar("Annoucement/create", $data);
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
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