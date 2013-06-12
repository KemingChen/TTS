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
    
    public function getAllBooks($offset,$limit){
        $this->db->select("bid, name, ISBN")->from("book")->limit($limit, $offset);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function browse($bid)
    {
        $sql = 'SELECT book.*,publisher.name as pname FROM `book`,publisher WHERE book.pid=publisher.pid and book.bid='.$bid;
        $categorySQL = 'SELECT cid,name FROM `categorycorrespond` natural join category where bid = '.$bid;
        $writerSQL = 'SELECT aid,name FROM writercorrespond NATURAL JOIN author WHERE bid ='.$bid;
        $translatorSQL = 'SELECT aid,name FROM  translatecorrespond NATURAL JOIN author WHERE bid ='.$bid;
        $discountSQL = 'SELECT d.name FROM  `book` NATURAL JOIN categorycorrespond AS c JOIN discountevent AS d ON c.cid = d.cid WHERE bid ='.$bid;
        $data['book'] = $this->db->query($sql)->row(0);
        $data['category'] = $this->db->query($categorySQL)->result();
        $data['writer'] = $this->db->query($writerSQL)->result();
        $data['translator'] = $this->db->query($translatorSQL)->result();
        $data['discounts'] = $this->db->query($discountSQL)->result();
        return $data;
    }
    
    public function selectBooks_by_OnShelfAttr($onshelf,$offset,$limit)
    {
        $this->db->select('bid,ISBN,name')->from('book')->where('onShelf',$onshelf)->limit($limit,$offset);
        $data['books'] = $this->db->get()->result();
        $this->db->select('')->from('book')->where('onshelf',$onshelf);
        $data['total_num_rows'] = $this->db->count_all_results();
        return $data;
    }
    
    public function getOnShelfAmount(){
        $this->db->from('book')->where('onshelf', TRUE);
        return $this->db->count_all_results();
    }
    
    public function getOffShelfAmount(){
        $this->db->from('book')->where('onshelf', FALSE);
        return $this->db->count_all_results();
    }
    
    public function getCategoryAmount($cid){
        $this->db->from('categorycorrespond')->where('cid', $cid);
        return $this->db->count_all_results();
    }
    
    public function getTotalAmount(){
        $this->db->from('book');
        return $this->db->count_all_results();
    }
    
    public function getAmountByBookName($name){
        $this->db->from('book');
        $this->db->like("name", $name);
        return $this->db->count_all_results();
    }
    
    public function getBookListByBookName($name, $limit, $offset){
        $this->db->select("");
        $this->db->from('book');
        $this->db->like("name", $name);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
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
    
   
    public function createBook($name, $ISBN, $cover, $pid, $publishedDate, $price, $description)
    {
	   	$bookData = array(
            'name' => $name,
            'isbn' => $ISBN,
            'cover' => $cover,
            'pid' => $pid,
            'publishedDate' => $publishedDate,
            'price' => $price,
    		'description' => $description,
            'onshelf' => 0
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