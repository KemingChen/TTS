<?

class Test extends CI_Controller
{
    public function view()
    {
        $data["id"] = "XXXXXX";
        $data["name"] = "匿名者";
        $this->load->model("template");
        $this->template->tIndex("index", $data);
    }
}

?>