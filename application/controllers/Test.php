<?

class Test extends CI_Controller
{
    public function t()
    {
        $this->load->database();
        $query = $this->db->query("Select * From test");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "id: " . $row->id;
                echo ", name: " . $row->name . "<br />";
            }
            echo "<br />";
        }
    }
}

?>