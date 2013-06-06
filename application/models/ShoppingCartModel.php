<?php

class ShoppingCartModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function addShoppingCart()
    {
        $data = array(
            'mid' => $this->input->post('mid'),
            'bid' => $this->input->post('bid'),
            'quantity' => $this->input->post('quantity')
    	);
	    return $this->db->insert('shoppingcartcorrespond', $data);
        //$query = $this->db->query("INSERT INTO SHOPPINGCARTCORRESPOND (mid, bid, quantity) VALUES ($mid, $bid, $quantity)");
    } 
    
    public function removeShoppingCart($mid, $bid)
    {
        $query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid AND bid = $bid");
    }
    
    public function modifyShoppingCart($mid, $bid, $quantity)
    {
        $query = $this->db->query("UPDATE SHOPPINGCARTCORRESPOND SET quantity = $quantity WHERE mid = $mid AND bid = $bid");
    }
    
    public function clearShoppingCart($mid)
    {
        $query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid");
    }
    
    public function automaticConfirmationEmail($mid)
    {
        $query = $this->db->query("SELECT A.email FROM ACCOUNT AS A WHERE A.mid = $mid");
        $this->load->library('email');
        $this->email->from('XXXX@ntut.edu.tw','TaipeiTech Store');//Needs to be changed
        //$mail = $query->result()->email;
        $this->email->to('$query->result()->email');
        $this->email->subject('Shopping Cart Confirmation');
        $this->email->message('This is a test');
        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    public function browseAllRecords()
    {
        $query = $this->db->query("SELECT * FROM shoppingcartcorrespond ");
        return $query;
    }
}

?>