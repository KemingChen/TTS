<?

class UploadCtrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->helper(array('form','url'));
        $this->load->library('upload');
    }
    
    public function upload($originFormPath)
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	
        $this->form_validation->set_rules('picture', 'Picture', 'required');
    	$this->form_validation->set_rules('description', 'Description', 'required');
    	
    	if ($this->form_validation->run() === FALSE)
    	{
            $this->template->uCSliderBar("", $originFormPath, "");
    	}
    	else
    	{
    	    //先檢查upload的限制  如果通過再上傳
        	if ( ! $this->upload->do_upload('picture'))
    		{
                show_error($this->upload->display_errors());
    		}
    		else
    		{
    			$data = array('upload_data' => $this->upload->data());
                return $file_data = file_get_contents($data['upload_data']['full_path']);
    		}
    	}
    }
}

?>