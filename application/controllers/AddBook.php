<?
class AddBook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("PublisherModel");
        //上傳檔案要用的
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->load->model("BookModel");
        $this->load->model("CategoryModel");
    }

    public function index($action="")
    {//bid cover name pid publishedDate price ISBN description onShelf
    
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('ISBN', 'ISBN', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('pid', 'Pid', 'required');
        $this->form_validation->set_rules('publishedDate', 'PublishedDate', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        
        $data['publisherList'] = $this->PublisherModel->getAllPublishers();
        $data['categoryList'] = $this->CategoryModel->getCategoryList();
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList['AddBook']['Active'] = 'active';
        
        if ($this->form_validation->run() === false) {
            $data["error"] = $action == "Upload" ? "true" : "false";
            $this->template->loadView("Manager", $slideBarList, "AddBookView", $data);
        } else {
            //先檢查upload的限制  如果通過再上傳
            if ($this->upload->do_upload('cover')) {
                
                $uploadData = $this->upload->data();
                $file_data = file_get_contents($uploadData['full_path']);
                
                //$file_data = file_get_contents($this->upload->data());
                //$this->AnnouncementModel->createAnnouncement($file_data);
                $name = $this->input->post("name");
                $ISBN = $this->input->post("ISBN");
                $cover = $file_data;//$this->input->post("cover");
                $pid = $this->input->post("pid");
                $publishedDate = $this->input->post("publishedDate");
                $price = $this->input->post("price");
                $description = $this->input->post("description");
                $bid = $this->BookModel->createBook($name, $ISBN, $cover, $pid, $publishedDate, $price, $description);
                
                $categories = $this->input->post("category");
                foreach($categories as $category){
                    //$cid = $this->CategoryModel->getCategoryName($category);
                    $this->BookModel->insertCategory($bid, $category);
                }
                
                $data['message'] = "true";
                $this->template->loadView("Manager", $slideBarList, "AddBookView", $data);
            } else {
                show_error($this->upload->display_errors());
            }
        }
    }
}

?>