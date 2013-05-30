<?php

class SelectAuthor extends CI_Controller
{
    public function index(){
        echo"hello";
    }
    
    public function select()
    {
        $this->load->database();
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $query = $this->db->query("Select * From author");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "id: " . $row->aid;
                echo ", name: " . $row->name . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "haha  it's nothing";  
        }
    }
}

?>