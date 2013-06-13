<?
class DiscountManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model('DiscountModel');
        $this->load->model("AnnouncementModel");
        $this->load->model("CategoryModel");
        $this->load->library('pagination');
    }

    public function index($offset=0)
    {
        $this->page($offset);
    }
    
    public function page($offset=0){
        $config = $this->getPaginationConfig();
        $this->pagination->initialize($config);
        
        
        $slideBarList = $this->MenuModel->getManagerList();
        $slideBarList["DiscountManagement"]['Active'] = "active";
        
        
        $data['categoryList'] = $this->CategoryModel->getCategoryList();
        $data["list"] = $this->DiscountModel->browseLimit($offset, 20);
        $data["offset"] = $offset;
        $data['pagination'] = $this->pagination->create_links();
        $this->template->loadView("Manager", $slideBarList, "DiscountManagementView", $data);
    }
    
    private function getPaginationConfig(){
        $config['base_url'] = base_url('DiscountManagement/page');
        $config['total_rows'] = $this->DiscountModel->getDiscountTotalAmount();
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['url_segment'] = 4;
        $config['num_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] =
            $config['first_tag_open'] = $config['last_tag_open'] = '<li>';
        $config['num_tag_close'] = $config['prev_tag_close'] = $config['next_tag_close'] =
            $config['first_tag_close'] = $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li = class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a>";
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        return $config;
    }
    
    public function update($deid, $cid, $name, $startTime, $endTime, $discountRate){
        $name = urldecode($name);
        if($this->DiscountModel->update($deid, $cid, $name, $startTime, $endTime, $discountRate)){
            echo "OK";
        }else{
            echo "ERROR";
        }
    }
    
    public function insertDiscount($cid, $name, $startTime, $endTime, $discount_rate){
        $name = urldecode($name);//
        if($this->DiscountModel->insertDiscount($cid, $name, $startTime, $endTime, $discount_rate)){
            echo "OK";
        }else{
            echo "ERROR";
        }
    }
}

?>