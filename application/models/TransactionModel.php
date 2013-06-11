<?php

class TransactionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model("ShoppingCartModel");
        $this->load->model("AccountModel");
        $this->load->model("GmailModel");
    }
    
    public function index(){
        //echo "hello transaction";
    }
    
    public function manageOrderState($oid, $state)
    {
        $data = array(
                        'state' => $state
        );
        $this->db->where('oid', $oid);
        $this->db->update('orderSummary', $data);
        if ($state === 'arrived')
        {
            $mid = $this->getMidByOid($oid);
            $this->sendThanksMail($mid, $oid);
        }
    }
    
    public function getMidByOid($oid)
    {
        $this->db->select('mid');
        $this->db->from('orderSummary');
        $this->db->where('oid', $oid);
        $data = $this->db->get();
        $dataResult = $data->result();
        $mid = $dataResult[0]->mid;
        return $mid;
    }
    
    public function getArrivedOrder()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'arrived'");
        $data = $this->db->get();
        return $data;
    }
    
    public function BrowseManageOrder()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'processing' OR state = 'shipping'");
        $data = $this->db->get();
        return $data;
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
    
    public function getOrderItemDataByOid($oid)
    {
        $this->db->select('SUM(o.quantity) as quantity, o.soldPrice, b.name');
        $this->db->from('orderitem as o, book as b');
        $this->db->where("o.oid = $oid AND o.bid = b.bid");
        $this->db->group_by('b.bid');
        $data = $this->db->get();
        return $data;
    }
    
    public function cancelTheTransaction($oid)
    {
        $this->db->trans_start();
        $this->deleteOrderItemByOid($oid);
        $this->db->where('oid', $oid);
        $this->db->delete('orderSummary');
        $this->db->trans_complete(); 
    }
    
    public function deleteOrderItemByOid($oid)
    {
        $this->db->where('oid', $oid);
        $this->db->delete('orderItem');
    }
    
    public function order($mid, $data)
    {
        $this->db->trans_start();
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        if($shoppingCartData->num_rows() > 0)
        {
            $this->db->insert('orderSummary', $data);
            $oid = $this->db->insert_id();
            $this->setOrderItemByOidAndCartData($oid, $shoppingCartData);
            // insert discount correspond
            $totalPrice = $this->getTotalPriceByOid($oid);
            $totalPriceData = array(
                                        'totalPrice' => $totalPrice
            );
            // insert rebate event
            // 肚琌ㄏノecoupon把计耞穝total price
            $this->db->where('oid', $oid);
            $this->db->update('ordersummary', $totalPriceData);
            $this->ShoppingCartModel->clearShoppingCart($mid);
            $this->sendInformMail($mid, $oid);
        }
        $this->db->trans_complete();
        
    }
    
    public function setOrderItemByOidAndCartData($oid, $shoppingCartData)
    {
        foreach($shoppingCartData->result() as $cartRow)
        {
            $cartQuantity = $cartRow->quantity;
            $stockData = $this->getStockDataByBid($cartRow->bid);
            while ($cartQuantity > 0)
            {
                echo "$cartQuantity" . "\r\n";
                echo "numofstock: " . "$stockData->num_rows()" . "\r\n";
                foreach($stockData->result() as $stockRow)
                {
                    echo "srid: " . "$stockRow->srid" . "\r\n";
                    $stockRestAmount = $stockRow->restAmount;
                    if($stockRestAmount >= $cartQuantity)
                    {
                        echo '$stockRestAmount >= $cartQuantity' . "\r\n";
                        $this->modifyStockRestAmountBySrid($stockRow->srid, $stockRestAmount - $cartQuantity);
                        $orderItemCostQuantity = $this->getOrderItemQuantityByCost($oid, $cartRow->bid, $stockRow->price);
                        if($orderItemCostQuantity > 0)
                        {
                            echo '$orderItemCostQuantity > 0' . "\r\n";
                            $this->modifyOrderItemQuantityByOidAndBidAndCost($oid, $cartRow->bid, $cartQuantity + $orderItemCostQuantity, $stockRow->price);
                        }
                        else
                        {
                            echo '$orderItemCostQuantity <= 0' . "\r\n";
                            echo '$stockRow->price' . "$stockRow->price" . "\r\n";
                            $this->addOrderItemByOidAndBid($oid, $cartRow->bid, $cartQuantity, $stockRow->price);
                        }
                        $cartQuantity = 0;
                        break 2;
                    }
                    else
                    {
                        echo '$stockRestAmount < $cartQuantity' . "\r\n";
                        $cartQuantity = $cartQuantity - $stockRestAmount;
                        $this->modifyStockRestAmountBySrid($stockRow->srid, 0);
                        $orderItemCostQuantity = $this->getOrderItemQuantityByCost($oid, $cartRow->bid, $stockRow->price);
                        if($orderItemCostQuantity > 0)
                        {
                            echo '$orderItemCostQuantity > 0' . "\r\n";
                            $this->modifyOrderItemQuantityByOidAndBidAndCost($oid, $cartRow->bid, $stockRow->restAmount + $orderItemCostQuantity, $stockRow->price);
                        }
                        else
                        {
                            echo '$orderItemCostQuantity <= 0' . "\r\n";
                            $this->addOrderItemByOidAndBid($oid, $cartRow->bid, $stockRow->restAmount, $stockRow->price);
                        }
                    }
                }
            }
        }
    }
    
    public function modifyStockRestAmountBySrid($srid, $quantity)
    {
        $stockRecordData = array(
                        'restAmount' => $quantity
        );
        $this->db->where('srid', $srid);
        $this->db->update('stockrecord', $stockRecordData);
    }
    
    public function modifyOrderItemQuantityByOidAndBidAndCost($oid, $bid, $quantity, $cost)
    {
        $orderItemData = array(
                        'quantity' => $quantity
        );
        $this->db->where('oid', $oid);
        $this->db->where('bid', $cartRow->bid);
        $this->db->where('cost', $cost);
        $this->db->update('orderitem', $orderItemData);
    }
    
    public function addOrderItemByOidAndBid($oid, $bid, $quantity, $cost)
    {
        $orderItemData = array(
                        'oid' => $oid,
                        'bid' => $bid,
                        'soldPrice' => $this->getSoldPriceByBid($bid),
                        'quantity' => $quantity,
                        'cost' => $cost
        );
        $this->db->insert('orderitem', $orderItemData);
    }
    
    public function getOrderItemQuantityByCost($oid, $bid, $cost)
    {
        $this->db->select('quantity');
        $this->db->from('orderitem');
        $this->db->where('oid', $oid);
        $this->db->where('bid', $bid);
        $this->db->where('cost', $cost);
        $data = $this->db->get();
        $dataResult = $data->result();
        if($data->num_rows() > 0)
        {
            $quantity = $dataResult[0]->quantity;
        }
        else
        {
            $quantity = 0;
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
        if($totalPriceData->num_rows() > 0)
        {
            $totalPrice = $totalPriceDataResult[0]->totalPrice;
        }
        else
        {
            $totalPrice = 0;
        }
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
        // 耞扳基 讽璹基 * discount
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
        $this->db->where('bid', $bid);
        $data = $this->db->get();
        if ($data->num_rows() > 0)
        {
            $dataResult = $data->result();
            $cost = $dataResult[0]->price;
            // 耞cost
        }
        else
        {
            $cost = 0;
        }
        return $cost;
    }
    
    public function getStockByBid($bid)
    {
        $this->db->select('bid, SUM(restAmount) as totalQuantity');
        $this->db->from('stockrecord');
        $this->db->where('bid', $bid);
        $this->db->where('restAmount >', 0);
        $this->db->group_by('bid');
        $data = $this->db->get();
        $dataResult = $data->result();
        $stockQuantity = $dataResult[0]->totalQuantity;
        return $stockQuantity;
    }
    
    public function getStockDataByBid($bid)
    {
        $this->db->select('srid, price, restAmount');
        $this->db->from('stockrecord');
        $this->db->where('bid', $bid);
        $this->db->where('restAmount >', 0);
        $data = $this->db->get();
        return $data;
    }
    
    public function isStockEnough($bid, $quantity)
    {
        if($this->getStockByBid($bid) >= $quantity)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function IsAllStockEnough($mid)
    {
        $stockEnough = true;
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        foreach($shoppingCartData->result() as $row)
        {
            $stockEnough = $stockEnough && $this->isStockEnough($row->bid, $row->quantity);
            if(!$this->isStockEnough($row->bid, $row->quantity))
            {
                $this->ShoppingCartModel->modifyShoppingCart($mid, $row->bid, 0);
            }
        }
        return $stockEnough;
    }
    
    public function resetShoppingCartQuantityFromTransactionErrorByMid($mid)
    {
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        foreach($shoppingCartData->result() as $row)
        {
            if($row->quantity > 0)
            {
                $this->ShoppingCartModel->modifyShoppingCart($mid, $row->bid, 0);
            }
            else
            {
                $restQuantity = $this->getStockByBid($row->bid);
                $this->ShoppingCartModel->modifyShoppingCart($mid, $row->bid, $restQuantity);
            }
        }
    }
    
    public function getRestQuantityShoppingCartData($mid)
    {
        $this->db->select('cart.quantity, b.name');
        $this->db->from('shoppingcartcorrespond as cart, book as b');
        $this->db->where('mid', $mid);
        $this->db->where("cart.bid = b.bid");
        $this->db->where('quantity >', 0);
        $data = $this->db->get();
        return $data;
    }

    public function sendInformMail($mid, $oid)
    {
        $recipient = $this->AccountModel->getEmailByMid($mid);
        $orderItemData = $this->getOrderItemDataByOid($oid);
        $orderItemString = "";
        $divider = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\r\n";
        foreach ($orderItemData->result() as $row)
        {
            $orderItemString = $orderItemString . $divider . "book name: " . $row->name . "\r\n" . "quantity: " . $row->quantity . "\r\n" . "sold price: " . $row->soldPrice . "\r\n"; 
        }
        $subject = 'TaipeiTech Store';
        $name = $this->AccountModel->getNameByMid($mid);
        $message = 'Hello, ' . $name . "\r\n" . "we have receved your order." . "\r\n\r\n" . "order id: " . $oid . "\r\n" . $orderItemString;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }

    public function sendThanksMail($mid, $oid)
    {
        $recipient = $this->AccountModel->getEmailByMid($mid);
        $orderItemData = $this->getOrderItemDataByOid($oid);
        $orderItemString = "";
        $divider = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\r\n";
        foreach ($orderItemData->result() as $row)
        {
            $orderItemString = $orderItemString . $divider . "book name: " . $row->name . "\r\n" . "quantity: " . $row->quantity . "\r\n" . "sold price: " . $row->soldPrice . "\r\n"; 
        }
        $subject = 'TaipeiTech Store';
        $name = $this->AccountModel->getNameByMid($mid);
        $message = 'Hello, ' . $name . "\r\n" . "your order has arrived." . "\r\n\r\n" . "order id: " . $oid . "\r\n" . $orderItemString . $divider . "\r\nThanks for your order.";
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }
}

?>