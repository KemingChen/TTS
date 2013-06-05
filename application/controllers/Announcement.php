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
    	$this->load->library('form_validation');
    }
    
    public function index()
    {
        $this->browse();
    }
    
    public function browse()
    {
        $data["annoucements"] = $this->AnnouncementModel->browseAnnouncement();
        $this->template->uCSliderBar("", "Announcement/browse", $data);
    }

    public function create()
    {
    	$this->form_validation->set_rules('description', 'Description', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->uCSliderBar("", "Announcement/create", "");
    	}
    	else
    	{
    	    //���ˬdupload������  �p�G�q�L�A�W��
        	if ( ! $this->upload->do_upload('picture'))
    		{
                show_error($this->upload->display_errors());
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
   
    public function update($adid)
    {
        $data["$adid"] = $adid;
        $picValid = $this->upload->do_upload('picture');
        if($this->input->post("description") || $picValid)
        {
            $file_data = '';
            if ($picValid)
    		{
  		        $data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
    		}   
            $this->AnnouncementModel->updateAnnouncement($adid,$file_data);    
            $this->browse();
        }
        else
        {
            $this->template->uCSliderBar("", "Announcement/update", $adid);
        }
    }
    
    public function delete($id)
    {
        echo $id;
        $this->AnnouncementModel->deleteAnnouncement($id);
        $this->browse();
    }
}

?>