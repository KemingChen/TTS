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
    
    public function getAnnouncementSize(){
        $query = $this->db->get('advertisement');
        $list = $query->result();
        $count = count($list);
        return $count;
    }
    
    public function getAnnouncementList()
    {
        $query = $this->db->get('advertisement');
        $list = $query->result();
        return $list;
    }
    
    public function createAnnouncement($imgData)
    {
	   	$data = array(
    		'description' => $this->input->post('description'),
            'picture' => $imgData
    	);
	
	   return $this->db->insert('advertisement', $data);
    }
    
    public function updateAnnouncement($id,$imgData)
    {
        $description = $this->input->post('description');
        if($imgData!='')
        {
            $this->db->set('picture', $imgData);   
        }
        if($description)
        {
            $this->db->set('description',$description);
        }
        $this->db->where('adid', $id);
        return $this->db->update('advertisement');
    }
    
    public function deleteAnnouncement($id)
    {
        return $this->db->delete('advertisement', array('adid' => $id));
    }
}

?>