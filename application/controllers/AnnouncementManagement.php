<?
class AnnouncementManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("AnnouncementModel");
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
    }

    public function index($param = null)
    {
        $this->page($param);
    }
    public function page($param=null)
    {
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["AnnouncementManagement"]['Active'] = "active";
        $content = "AnnouncementManagementView";
        
        $page = $param === null ? 1 : $param;
        $selectNum = 5;
        $offset = $selectNum * ($page - 1);

        $info['total_NumRows'] = $this->AnnouncementModel->getAnnouncementSize();
        $info["list"] = $this->AnnouncementModel->getAnnouncementListLimit($offset, $selectNum);
        $info["page"] = $page;
        $info["pages"] = ceil($info["total_NumRows"] / $selectNum);
        
        $this->template->loadView("Manager", $slideBarList, $content, $info);
    }
    
    public function create()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["AnnouncementManagement"]['Active'] = "active";
        
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === false) 
        {
            $this->page();
            //$this->template->loadView("Manager", $slideBarList, "Announcement/create", array());
        } 
        else 
        {
            //先檢查upload的限制  如果通過再上傳
            if ($this->upload->do_upload('picture')) {
                $data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
                $this->AnnouncementModel->createAnnouncement($file_data);
                $this->page();
            } else {
                show_error($this->upload->display_errors());
            }
        }
    }

    public function update($adid)
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["AnnouncementManagement"]['Active'] = "active";
        //print_r($this->input->post());
        $data["adid"] = $adid;
        $picValid = $this->upload->do_upload('picture');
        if ($this->input->post("description") || $picValid) 
        {
            $file_data = '';
            if ($picValid) {
                $data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
            }
            $this->AnnouncementModel->updateAnnouncement($adid, $file_data);
            $this->page();
            //echo 'ok';
        }
        else 
        {
            $this->page();            
            //$this->template->loadView("Manager", $slideBarList, "Announcement/update", $data);
            //echo 'error';
        }
    }
    
    public function delete($id)
    {
        echo $this->AnnouncementModel->deleteAnnouncement($id);
    }
}

?>