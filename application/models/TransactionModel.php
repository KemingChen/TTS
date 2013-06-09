<?php

class TransactionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model("ShoppingCartModel");
    }
    
    public function index(){
        //echo "hello transaction";
    }

    public function browseTransactionRecords()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByTimeInterval($start, $end)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('orderTime >=', $start);
        $this->db->where('orderTime <=', $end);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByState($state)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('state', $state);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByLimit($start, $length)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->limit($length, $start);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByMid($mid)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('mid', $mid);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByTimeIntervalById($mid, $start, $end)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('mid', $mid);
        $this->db->where('orderTime >=', $start);
        $this->db->where('orderTime <=', $end);
        $data = $this->db->get();
        return $data;
    }
    
    public function browseTransactionRecordsByStateByMid($mid, $state)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where('state', $state);
        $this->db->where('mid', $mid);
        $data = $this->db->get();
        return $data;
    }
    
    public function cancelTheTransaction($oid)
    {
        $this->db->where('oid', $oid);
        $this->db->delete('orderSummary'); 
    }
    
    public function order($mid, $data)
    {
        $this->db->trans_start();
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        echo $shoppingCartData->num_rows();
        if($shoppingCartData->num_rows() > 0)
        {
            $this->db->insert('orderSummary', $data);
            $oid = $this->db->insert_id();
            $this->setOrderItemByOidAndCartData($oid, $shoppingCartData);
            $totalPrice = $this->getTotalPriceByOid($oid);
            $totalPriceData = array(
                                        'totalPrice' => $totalPrice
            );
            $this->db->where('oid', $oid);
            $this->db->update('ordersummary', $totalPriceData);
            $this->ShoppingCartModel->clearShoppingCart($mid);
            $this->db->trans_complete();
        }
        
    }
    
    public function setOrderItemByOidAndCartData($oid, $shoppingCartData)
    {
        foreach($shoppingCartData->result() as $row)
        {
            $orderItemData = array(
                                        'oid' => $oid,
                                        'bid' => $row->bid,
                                        'quantity' => $row->quantity,
                                        'soldPrice' => $this->getSoldPriceByBid($row->bid),
                                        'cost' => $this->getCostByBid($row->bid)
            );
            $this->db->insert('orderItem', $orderItemData);
        }
    }
    
    public function getTotalPriceByOid($oid)
    {
        $this->db->select('oid, SUM(quantity * soldPrice) as totalPrice');
        $this->db->from('orderItem');
        $this->db->where('oid', $oid);
        $this->db->group_by('oid');
        $totalPriceData = $this->db->get();
        $totalPriceDataResult = $totalPriceData->result();
        $totalPrice = $totalPriceDataResult[0]->totalPrice;
        return $totalPrice;
    }
    
    public function getShoppingCartDataByMid($mid)
    {
        $this->db->select('bid, quantity');
        $this->db->from('shoppingcartcorrespond');
        $this->db->where('mid', $mid);
        $data = $this->db->get();
        return $data;
    }
    
    public function getSoldPriceByBid($bid)
    {
        $this->db->select('price');
        $this->db->from('book');
        $this->db->where('bid', $bid);
        $data = $this->db->get();
        $dataResult = $data->result();
        $soldPrice = $dataResult[0]->price;                
        return $soldPrice;
    }
    
    public function getCostByBid($bid)
    {
        $this->db->select('*');
        $this->db->from('stockrecord');
        $this->where('bid', $bid);
        $data = $this->db->get();
        if ($data->num_rows() > 0)
        {
            $dataResult = $data->result();
            $cost = $dataResult[0]->price;
        }
        else
        {
            $cost = 0;
        }
        return $cost;
    }
}

?>