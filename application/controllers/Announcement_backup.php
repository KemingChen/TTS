<?
class Announcement_backup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("AnnouncementModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->browse();
    }

    public function browse()
    {
        $data["announcements"] = $this->AnnouncementModel->browseAnnouncement();
        //$this->template->uCSliderBar("", "Announcement/browse", $data);
        $data["size"] = sizeof($data["announcements"]->result());
        $this->template->loadView("Category", array(), "Announcement/browse", $data);
        //$this->template->view("", "", "Announcement/browse", $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === false) {
            //$headerActiveID, $slideBarList, $content, $contentData

            $this->template->loadView("Category", array(), "Announcement/create", array());
            //$this->template->view("", "", "Announcement/create", "");
        } else {
            //先檢查upload的限制  如果通過再上傳
            if (!$this->upload->do_upload('picture')) {
                show_error($this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_data = file_get_contents($data['upload_data']['full_path']);
                $this->AnnouncementModel->createAnnouncement($file_data);
                $this->browse();
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
        echo $id;
        $this->AnnouncementModel->deleteAnnouncement($id);
        $this->browse();
    }
}

?>