<?php

class BookModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function updateOnShelf($bid)
    {
        $data = array(
               'onshelf' => true,
            );
        $this->db->where('bid', $bid);
        $this->db->update('book', $data); 
        //$query = $this->db->query("Update book set onshelf = true where ISBN='$ISBN'");
    }
    
    public function updateOffShelf($bid)
    {
        $data = array(
               'onshelf' => false,
            );
        $this->db->where('bid', $bid);
        $this->db->update('book', $data); 
        //$query = $this->db->query("Update book set onshelf = false where ISBN='$ISBN'");
    }
    
    public function createBookInformation($cover)
    {
	   	$data = array(
            'bid' => '',
            'cover' => $cover,
            'name' => $this->input->post('name'),
            'pid' => $this->input->post('pid'),
            'publishedDate' => $this->input->post('publishedDate'),
            'price' => $this->input->post('price'),
            'isbn' => $this->input->post('isbn'),
    		'description' => $this->input->post('description'),
            'onshelf' => $this->input->post('onshelf')
    	);
	
	   return $this->db->insert('book', $data);
    }
    
    public function editBookInformation($cover)
    {
        $bid = $this->input->post('bid');
        $data = array(
            'isbn' => $this->input->post('isbn'),
            'name' => $this->input->post('name'),
            'pid' => $this->input->post('pid'),
            'publishedDate' => $this->input->post('publishedDate'),
            'price' => $this->input->post('price'),
    		'description' => $this->input->post('description'),
            'cover' => $cover,
            'onshelf' => $this->input->post('onshelf')
    	);
        $this->db->where('bid', $bid);
        $this->db->update('book', $data);
        //$query = $this->db->query("Update book set cover = '$cover', name = '$name', pid = $pid, publishedDate = '$publishedDate', price = $price, ISBN = '$ISBN', description = 'qweqweqwe', onShelf = 1 Where bid = $bid");
    }
    
    public function searchByCategory($categoryID, $limit, $offset)
    {
        //$category = $this->input->post('category');
        //$limit = $this->input->post('limit');
        //$offset = $this->input->post('offset');
        //$authorName = $this->input->post('authorName');
        //$category = urldecode($category);
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC');
        $this->db->where("C.cid = '$categoryID' AND CC.cid = C.cid AND B.bid = CC.bid ");
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
        
        //$query = $this->db->query("WHERE C.name = '$category' AND CC.cid = C.cid AND B.bid = CC.bid LIMIT $start , $end");
        //return $query;
    }
    
    public function searchByID($id, $limit, $offset)
    {
        $this->db->select('B.bid, B.name, B.cover, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B');
        $this->db->where("B.bid = $id ");
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
        //$query = $this->db->query("SELECT  FROM BOOK AS B WHERE B.bid = $id limit");
        //return $query;
    }
    
    public function browseAllBooks()
    {
        $query = $this->db->query("SELECT * FROM BOOK ");
        return $query;
    }
    
    public function browseSelectedBook($bid)
    {
        $query = $this->db->query("SELECT * FROM BOOK WHERE bid = '$bid'");
        return $query;
    }
    
    public function countTotal()
    {
        $query = $this->db->query("SELECT bid FROM BOOK ");
        $count = sizeof($query->result());
        return $count;
    }
    
    
    
}
?>