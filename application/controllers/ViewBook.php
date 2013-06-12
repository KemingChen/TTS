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
        $this->load->model("authority");
    }

    public function book($bid=1, $cid=0, $offset=0)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $content = "BookView";
        
        $data = $this->BookModel->browse($bid);
        $data["offset"] = $offset;
        
        $cid = $cid == 0 ? $data["category"][0]->cid : $cid;
        $data["cid"] = $cid;
        $data["cname"] = '';
        foreach ($data["category"] as $object)
        {
            if($object->cid == $data["cid"]) 
            {
                $data["cname"] = $object->name;
                $slideBarList[$cid]['Active'] = "active";
                break;
            }
        }
        $data['isLogin'] = $this->authority->isLogin();
        
        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>