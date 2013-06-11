<?php

class ShoppingCartModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getQuantity($mid, $bid){
        $query = $this->db->get_where("shoppingcartcorrespond", array("mid" => $mid, "bid"=> $bid));
        $list = $query->result();
        return $list[0]->quantity;
    }
    
    public function addShoppingCart($mid, $bid, $quantity)
    {
        $query = $this->db->get_where("shoppingcartcorrespond", array("mid" => $mid, "bid"=> $bid));
        $result = $query->result();
        if(count($result)>0){
            //have this record
            $originQuantity = $this->getQuantity($mid, $bid);
    	    $this->modifyShoppingCart($mid, $bid, $originQuantity + $quantity);
        }else{
            $data = array(
                'mid' => $mid,
                'bid' => $bid,
                'quantity' => $quantity
        	);
    	    return $this->db->insert('shoppingcartcorrespond', $data);
        }
        //$query = $this->db->query("INSERT INTO SHOPPINGCARTCORRESPOND (mid, bid, quantity) VALUES ($mid, $bid, $quantity)");
    } 
    
    public function removeShoppingCart($mid, $bid)
    {
        $this->db->where('mid',$mid);
        $this->db->where('bid',$bid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid AND bid = $bid");
    }
    
    public function modifyShoppingCart($mid, $bid, $quantity)
    {
        $data = array(
               'quantity' => $quantity,
            );
        $this->db->where('mid',$mid);
        $this->db->where('bid',$bid);
        $this->db->update('shoppingcartcorrespond', $data); 
        //$query = $this->db->query("UPDATE SHOPPINGCARTCORRESPOND SET quantity = $quantity WHERE mid = $mid AND bid = $bid");
    }
    
    public function clearShoppingCart($mid)
    {
        //$mid = $this->input->post('mid');
        $this->db->where('mid',$mid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid");
    }
    
    public function automaticConfirmationEmail($mid)
    {
        
    }
    
    public function getWholeShoppingCart($mid, $limit=10, $offset=0)
    {
        $selectSQL = 'bid,quantity, b.name, ISBN, d.name AS discountName, percentOff, price, price * ( 100 - IFNULL( percentOff, 0 ) ) /100 AS soldPrice';
        $this->db->select($selectSQL,false);
        $this->db->from('shoppingcartcorrespond as sc NATURAL JOIN book AS b NATURAL JOIN categorycorrespond AS c');
        $this->db->join('discountevent AS d', 'd.cid = c.cid','left');
        $this->db->where("sc.mid = $mid AND b.bid = sc.bid");
        $this->db->where('NOW( ) BETWEEN d.startTime AND d.endTime');
        $this->db->limit($limit, $offset);
        $data["cart"] = $this->db->get();
        
        $this->db->select('')->from('shoppingcartcorrespond')->where('mid',$mid);
        $data["total_NumRows"] = $this->db->get()->num_rows();
        $data["num_rows"] = $data["cart"]->num_rows();
        
        return $data;
    }
    
    public function getCustomerInformation($mid)
    {
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
    
    public function confirmEmailContent($mid)
    {
        $this->db->select('sc.bid, b.name, SUM(sc.quantity) as totalQuantity, SUM(sc.quantity * b.price) as totalPrice');
        $this->db->from('shoppingcartcorrespond as sc, book as b');
        $this->db->where("sc.mid = $mid AND b.bid = sc.bid");
        $this->db->group_by("sc.bid");
        $data = $this->db->get();
        return $data;
    }
}

?>