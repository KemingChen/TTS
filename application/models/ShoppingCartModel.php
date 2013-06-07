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
    
    public function removeShoppingCart()
    {
        $mid = $this->input->post('mid');
        $bid = $this->input->post('bid');
        $this->db->where('mid',$mid);
        $this->db->where('bid',$bid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid AND bid = $bid");
    }
    
    public function modifyShoppingCart()
    {
        $data = array(
               'quantity' => $this->input->post('quantity'),
            );
        $mid = $this->input->post('mid');
        $bid = $this->input->post('bid');
        $this->db->where('mid',$mid);
        $this->db->where('bid',$bid);
        $this->db->update('shoppingcartcorrespond', $data); 
        //$query = $this->db->query("UPDATE SHOPPINGCARTCORRESPOND SET quantity = $quantity WHERE mid = $mid AND bid = $bid");
    }
    
    public function clearShoppingCart($mid)
    {
        $mid = $this->input->post('mid');
        $this->db->where('mid',$mid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid");
    }
    
    public function automaticConfirmationEmail($mid)
    {
        
    }
    
    public function getWholeShoppingCart()
    {
        $mid = $this->input->post('mid');
        $limit = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $this->db->select('mid, bid, quantity');
        $this->db->from('shoppingcartcorrespond');
        $this->db->where('mid', $mid);
        $this->db->limit($limit, $offset);
        $data = $this->db->get();
        return $data;
    }
    
    public function getCustomerInformation()
    {
        $mid = $this->input->post('mid');
        $this->db->select('name, email');
        $this->db->from('account');
        $this->db->where('mid', $mid);
        $data = $this->db->get();
        return $data;
        
    }
    
    public function browseAllRecords()
    {
        $query = $this->db->query("SELECT * FROM shoppingcartcorrespond ");
        return $query;
    }
}

?>