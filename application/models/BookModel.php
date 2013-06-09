<?php

class BookModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function listAllBook($offset,$limit)
    {
        $sql = 'SELECT bid, name, cover FROM book Limit '.$offset.','.$limit;
        $data['books'] = $this->db->query($sql);
        $data["num_rows"] = $data["books"]->num_rows();
        $data["total_NumRows"] = $this->db->count_all('book');
        $data['books'] = $data['books']->result();
        return $data;
    }
    
    public function browse($bid)
    {
        $sql = 'SELECT book.*,publisher.name as pname FROM `book`,publisher WHERE book.pid=publisher.pid and book.bid='.$bid;
        $categorySQL = 'SELECT cid,name FROM `categorycorrespond` natural join category where bid = '.$bid;
        $writerSQL = 'SELECT aid,name FROM writercorrespond NATURAL JOIN author WHERE bid ='.$bid;
        $translatorSQL = 'SELECT aid,name FROM  translatecorrespond NATURAL JOIN author WHERE bid ='.$bid;
        
        $data['book'] = $this->db->query($sql)->row(0);
        $data['category'] = $this->db->query($categorySQL)->result();
        $data['writer'] = $this->db->query($writerSQL)->result();
        $data['translator'] = $this->db->query($translatorSQL)->result();
        return $data;
    }
    
    public function selectBooks_by_OnShelfAttr($onshelf,$offset,$limit)
    {
        $this->db->select('bid,ISBN,name')->from('book')->where('onshelf',$onshelf)->limit($limit,$offset);
        $data['books'] = $this->db->get()->result();
        $this->db->select('')->from('book')->where('onshelf',$onshelf);
        $data['total_num_rows'] = $this->db->count_all_results();
        return $data;
    }
        
    public function updateOnShelf($bid,$true_or_false)
    {
        $data = array(
               'onshelf' => $true_or_false,
            );
        $this->db->where('bid', $bid);
        $this->db->update('book', $data); 
    }
   
    public function createBookInformation($cover)
    {
	   	$bookData = array(
            'cover' => $cover,
            'name' => $this->input->post('name'),
            'pid' => $this->input->post('pid'),
            'publishedDate' => $this->input->post('publishedDate'),
            'price' => $this->input->post('price'),
            'isbn' => $this->input->post('isbn'),
    		'description' => $this->input->post('description'),
            'onshelf' => $this->input->post('onshelf')
    	);
	    $this->db->insert('book', $bookData);
        return $this->db->insert_id();
    }
    
    public function editBookInformation($bid,$cover)
    {
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
        
    public function insertCategory($bid, $cid)
    {
        $data = array(
            'bid' => $bid,
            'cid' => $cid
        );
        $this->db->insert('categorycorrespond', $data);
    }
    
    public function insertWriter($bid, $aid)
    {
        $data = array(
            'bid' => $bid,
            'aid' => $aid
        );
        $this->db->insert('writercorrespond', $data);
    }
    
    public function insertTranslator($bid, $aid)
    {
        $data = array(
            'bid' => $bid,
            'aid' => $aid
        );
        $this->db->insert('translatecorrespond', $data);
    }
}
?>