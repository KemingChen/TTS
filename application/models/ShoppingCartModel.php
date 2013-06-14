<?php

class ShoppingCartModel extends CI_Model
{
    //parent::__construct();
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getQuantity($mid, $bid)
    {
        $query = $this->db->get_where("shoppingcartcorrespond", array("mid" => $mid,
            "bid" => $bid));
        $list = $query->result();
        return $list[0]->quantity;
    }

    public function addShoppingCart($mid, $bid, $quantity)
    {
        $query = $this->db->get_where("shoppingcartcorrespond", array("mid" => $mid,
            "bid" => $bid));
        $result = $query->result();
        if (count($result) > 0) {
            //have this record
            $originQuantity = $this->getQuantity($mid, $bid);
            $this->modifyShoppingCart($mid, $bid, $originQuantity + $quantity);
        } else {
            $data = array('mid' => $mid, 'bid' => $bid, 'quantity' => $quantity);
            return $this->db->insert('shoppingcartcorrespond', $data);
        }
        //$query = $this->db->query("INSERT INTO SHOPPINGCARTCORRESPOND (mid, bid, quantity) VALUES ($mid, $bid, $quantity)");
    }

    public function removeShoppingCart($mid, $bid)
    {
        $this->db->where('mid', $mid);
        $this->db->where('bid', $bid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid AND bid = $bid");
    }

    public function modifyShoppingCart($mid, $bid, $quantity)
    {
        $data = array('quantity' => $quantity, );
        $this->db->where('mid', $mid);
        $this->db->where('bid', $bid);
        $this->db->update('shoppingcartcorrespond', $data);
        //$query = $this->db->query("UPDATE SHOPPINGCARTCORRESPOND SET quantity = $quantity WHERE mid = $mid AND bid = $bid");
    }

    public function clearShoppingCart($mid)
    {
        //$mid = $this->input->post('mid');
        $this->db->where('mid', $mid);
        $this->db->delete('shoppingcartcorrespond');
        //$query = $this->db->query("DELETE FROM SHOPPINGCARTCORRESPOND WHERE mid = $mid");
    }

    public function automaticConfirmationEmail($mid)
    {

    }

    public function getWholeShoppingCart($mid)
    {
        $sql = 'SELECT b.bid, b.name,ISBN,price,quantity,t.name AS discountName, 
            price * IFNULL( discount_rate, 1 ) AS soldPrice
            FROM  `book` AS b
            RIGHT JOIN (
            
            SELECT sc.bid, quantity, d.name, discount_rate
            FROM  `shoppingcartcorrespond` AS sc
            NATURAL JOIN  `categorycorrespond` AS c
            LEFT JOIN  `discountevent` AS d ON  `d`.`cid` =  `c`.`cid` 
            AND NOW( ) 
            BETWEEN d.startTime
            AND d.endTime + INTERVAL 1 DAY
            WHERE mid = ' . $mid . '
            ORDER BY discount_rate
            ) AS t ON b.bid = t.bid
            GROUP BY b.bid';

        $data["cart"] = $this->db->query($sql)->result();
        
        $this->db->from('shoppingcartcorrespond')->where('mid', $mid);
        $data["total_NumRows"] = $this->db->count_all_results();
                
        $data["after_discount_total_price"] = 0;
        foreach ($data["cart"] as $item) {
            $data["after_discount_total_price"] += $item->quantity * $item->soldPrice;
        }

        $this->db->select('name,threshold,price')->from('rebateevent');
        $this->db->where('Now() between startTime and endTime + INTERVAL 1 DAY');
        $this->db->where($data["after_discount_total_price"] . ' >= threshold', '', false);
        $this->db->order_by('(price/threshold)', 'desc');
        $this->db->limit(1,0);
        
        $query = $rebate = $this->db->get(); //->row(0);
        if ($query->num_rows() > 0) {
            $rebate = $query->row(0);
            $data["rebateName"] = $rebate->name;
            $data["rebatePrice"] = $rebate->price;
        }else{
            $data["rebateName"] = "無任何折扣";
            $data["rebatePrice"] = 0    ;
            
        }
        $data["totalPrice"] = round($data["after_discount_total_price"] - $data["rebatePrice"]);
        
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