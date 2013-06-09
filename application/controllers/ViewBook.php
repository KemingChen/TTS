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

    public function book($bid=1, $cid=1, $page=1)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "BookView";
        
        $array = $this->BookModel->browse($bid);
        $data["book"] = $array["book"];
        $data['writer'] = $array["writer"];
        $data['translator'] = $array["translator"];
        $data["category"] = $array['category'];
        $data["page"] = $page;
        $cid = $cid === null ? $data["category"][0]->cid : $cid;
        
        $data["cid"] = $cid;
        foreach ($data["category"] as $object)
        {
            if($object->cid == $data["cid"]) 
            {
                $data["cname"] = $object->name;
                break;
            }
        }
        $slideBarList[$cid]['Active'] = "active";
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>