<?php

class CustomSearchModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function searchByAuthor($authorName, $offset = 0, $limit = 99999)
    {
        $this->db->select('B.bid, B.name, A.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('A.name', "$authorName");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $this->db->limit($limit, $offset);

        $data = $this->db->get()->result();
        return $data;
    }

    public function getSearchByAuthorSize($authorName)
    {
        $this->db->select('B.bid, B.name, A.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, AUTHOR AS A, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('A.name', "$authorName");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        return $this->db->count_all_results();
    }

    public function searchByName($name, $offset = 0, $limit = 99999)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover as cover, p.name as publisher, B.publishedDate, B.price, B.ISBN as ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p ');
        $this->db->like('B.name', "$name");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $this->db->limit($limit, $offset);
        //$this->db->where("B.name = '$name'");
        $data = $this->db->get()->result();
        return $data;
    }

    public function getSearchByNameSize($name)
    {
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p ');
        $this->db->like('B.name', "$name");
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        return $this->db->count_all_results();
    }

    public function searchByBooksellers($sellerName, $offset=0, $limit=99999)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, PUBLISHER AS P, author as a, WRITERCORRESPOND AS W');
        $this->db->like('P.name', "$sellerName");
        $this->db->where("B.pid = P.pid AND W.aid = A.aid AND B.bid = W.bid");
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getSearchByBooksellersSize($sellerName)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, PUBLISHER AS P, author as a, WRITERCORRESPOND AS W');
        $this->db->like('P.name', "$sellerName");
        $this->db->where("B.pid = P.pid AND W.aid = A.aid AND B.bid = W.bid");
        return $this->db->count_all_results();
    }

    public function searchByPublishedDate($publishedDate, $offset=0, $limit=99999)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->where("B.publishedDate = '$publishedDate' AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $data = $this->db->get()->result();
        return $data;
    }

    public function getSearchPublishedDateSize($publishedDate)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->where("B.publishedDate = '$publishedDate' AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        return $this->db->count_all_results();
    }

    public function searchByCategory($category, $offset=0, $limit=99999)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, CATEGORY AS C, CATEGORYCORRESPOND AS CC, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('C.name', $category);
        $this->db->where("CC.cid = C.cid AND B.bid = CC.bid AND W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $data = $this->db->get();
        return $data;
    }

    public function searchByISBN($isbn, $offset=0, $limit=99999)
    {
        $this->db->select('B.bid as bid, B.name as name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN as ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('B.ISBN', $isbn);
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getSearchByISBNSize($isbn)
    {
        $this->db->select('B.bid, B.name, a.name as author, B.cover, p.name as publisher, B.publishedDate, B.price, B.ISBN, B.onShelf');
        $this->db->from('BOOK AS B, author as a, WRITERCORRESPOND AS W, publisher as p');
        $this->db->like('B.ISBN', $isbn);
        $this->db->where("W.aid = A.aid AND B.bid = W.bid AND B.pid = P.pid");
        return $this->db->count_all_results();
    }
}

?>