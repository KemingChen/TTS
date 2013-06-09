<?
class ViewBook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
        $this->load->model("CategoryModel");
        $this->load->model("BookModel");
    }

    public function book($cid=1, $bid=1)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $slideBarList[$cid]['Active'] = "active";
        $content = "BookView";
        
        $data["cname"] = $this->CategoryModel->getCategoryName($cid);
        $data["cid"] = $cid;
        $array = $this->BookModel->browse($bid);
        $data["book"] = $array["book"];
        $data['writer'] = $array["writer"];
        $data['translator'] = $array["translator"];
        $data['category'] = $array['category'];
        
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>