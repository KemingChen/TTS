<?php

class AnnouncementModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function browseAnnouncement()
    {
        $query = $this->db->get('advertisement');
        return $query;
    }
    
    public function createAnnouncement($imgData)
    {
        //$imgData = mysql_real_escape_string(file_get_contents($data['upload_data']['full_path']));
        //$this->input->post('picture')
	   	$data = array(
    		'description' => $this->input->post('description'),
            'picture' => $imgData
    	);
	
	   return $this->db->insert('advertisement', $data);
    }
}

?>