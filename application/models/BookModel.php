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
	   	$bookData = array(
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
        //$cid = $this->input->post('categoryID');
        
	    return $this->db->insert('book', $bookData);
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
        $this->db->select('b.bid, b.cover, b.name, a.name as author, p.name as publisher, b.publishedDate, b.price, b.ISBN, b.onShelf');
        $this->db->from('book as b, author as a, writercorrespond as wc, publisher as p, CATEGORY AS C, CATEGORYCORRESPOND AS CC');
        $this->db->where("C.cid = '$categoryID' AND CC.cid = C.cid AND B.bid = CC.bid AND wc.bid = b.bid AND a.aid = wc.aid AND p.pid = b.pid");
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
        
        //$query = $this->db->query("WHERE C.name = '$category' AND CC.cid = C.cid AND B.bid = CC.bid LIMIT $start , $end");
        //return $query;
    }
    
    public function searchByID($id, $limit, $offset)
    {
        $this->db->select('b.bid, b.cover, b.name, a.name as author, p.name as publisher, b.publishedDate, b.price, b.ISBN, b.onShelf');
        $this->db->from('book as b, author as a, writercorrespond as wc, publisher as p');
        $this->db->where("b.bid = $id AND wc.bid = b.bid AND a.aid = wc.aid AND p.pid = b.pid");
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
        //$query = $this->db->query("SELECT  FROM BOOK AS B WHERE B.bid = $id limit");
        //return $query;
    }
    
    public function createCategory($categoryName)
    {
        $this->db->select('cid');
        $this->db->from('categorycorrespond');
        $this->db->where('name', $categoryName);
        $data = $this->db->get();
        $result = $data->result();
        if($result[0]->cid != NULL)
        {
            show_error("category already have!");
        }
        else
        {
            $data = array(
                'cid' => '',
                'name' => $categoryName
            );
            $this->db->insert('category', $data);
        }
        $this->db->select('cid');
        $this->db->from('categorycorrespond');
        $this->db->where('name', $categoryName);
        $cid = $this->db->get();
        $result = $cid->result();
        return $result[0]->cid;
    }
    
    public function createPublisher($publisherName)
    {
        $this->db->select('pid');
        $this->db->from('publisher');
        $this->db->where('name', $publisherName);
        $data = $this->db->get();
        $result = $data->result();
        if($result[0]->pid != NULL)
        {
            show_error("publisher already have!");
            return false;
        }
        //else
//        {
//            $data = array(
//                'cid' => '',
//                'name' => $categoryName
//            );
//            $this->db->insert('category', $data);
//        }
    }
    
    public function createCategoryCorrespond($bid, $cid)
    {
        $data = array(
            'bid' => $bid,
            'cid' => $cid
        );
        $this->db->insert('categorycorrespond', $data);
    }
    
    public function browseCategoryCorrespond()
    {
        $query = $this->db->query("SELECT * FROM categorycorrespond ");
        return $query;
    }
    
    public function getIDByISBN($isbn)
    {
        $this->db->select('bid');
        $this->db->from('book');
        $this->db->where('isbn', $isbn);
        $bid = $this->db->get();
        $result = $bid->result();
        return $result[0]->bid;
        //$query = $this->db->query("SELECT bid FROM BOOK WHERE isbn = '$isbn'");
        //return $query;
    }
    
    public function browseAllBooks()
    {
        $this->db->select('b.bid, b.cover, b.name, a.name as author, p.name as publisher, b.publishedDate, b.price, b.ISBN, b.onShelf');
        $this->db->from('book as b, author as a, writercorrespond as wc, publisher as p');
        $this->db->where("wc.bid = b.bid AND a.aid = wc.aid AND p.pid = b.pid");
        //$query = $this->db->query("SELECT b.bid, b.cover, b.name, b.publishedDate, b.price, b.ISBN, b.onshelf FROM BOOK ");
        return $this->db->get();
    }
    
    public function browseSelectedBook($bid)
    {
        $query = $this->db->query("SELECT * FROM BOOK WHERE bid = $bid");
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