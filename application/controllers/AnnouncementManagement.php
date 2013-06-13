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
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('form_validation');
        
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["AnnouncementManagement"]['Active'] = "active";
        
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() === false) {
            $this->template->loadView("Manager", $slideBarList, "Announcement/create", array());
        } else {
            //���ˬdupload������  �p�G�q�L�A�W��
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
        $data["adid"] = $adid;
        $picValid = $this->upload->do_upload('picture');
        if ($this->input->post("description") || $picValid) {
            $file_data = '';
            if ($picValid) {
                $data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
            }
            $this->AnnouncementModel->updateAnnouncement($adid, $file_data);
            $this->browse();
        } else {
            $this->template->view("", "", "Announcement/update", $data);
        }
    }
    
    public function delete($id)
    {
        echo $this->AnnouncementModel->deleteAnnouncement($id);
    }
}

?>