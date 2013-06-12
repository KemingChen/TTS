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
        $this->load->model("BookModel");
    }

    public function index()
    {
        //echo "hello transaction";
    }

    public function manageOrderState($oid, $state)
    {
        $data = array('state' => $state);
        $this->db->where('oid', $oid);
        $this->db->update('orderSummary', $data);
        if ($state === 'arrived') {
            $mid = $this->getMidByOid($oid);
            $this->sendThanksMail($mid, $oid);
        }
    }
    
    public function getOrderSummaryByOId($oid){
        $query = $this->db->get_where("orderSummary", array("oid"=>$oid));
        $list = $query->result();
        if(count($list)>0){
            return $list[0];
        }return NULL;
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

    public function getArrivedOrderAmount()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'arrived'");
        $count = $this->db->count_all_results();
        return $count;
    }


    public function getArrivedOrderLimit($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'arrived'");
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
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

    public function getNotArrivedOrderLimit($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'processing' OR state = 'shipping'");
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
        return $data;
    }

    public function getNotArrivedOrderAmount()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->where("state = 'processing' OR state = 'shipping'");
        $count = $this->db->count_all_results();
        return $count;
    }

    public function browseTransactionRecordsLimit($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result();
        return $data;
    }
    
    public function getTransactionRecordAmount()
    {
        $this->db->select('*');
        $this->db->from('orderSummary');
        $count = $this->db->count_all_results();
        return $count;
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
        $this->db->select('b.bid as bid, SUM(o.quantity) as quantity, o.soldPrice, b.name, b.ISBN');
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

    public function order($mid, $data, $couponCode)
    {
        $this->db->trans_start();
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        if ($shoppingCartData->num_rows() > 0) {
            $this->db->insert('orderSummary', $data);
            $oid = $this->db->insert_id();
            $this->setOrderItemByOidAndCartData($oid, $shoppingCartData);
            $totalPrice = $this->getTotalPriceByOid($oid);
            $orderTime = $this->getOrderTimeByOid($oid);
            $rebateEvent = $this->getBestRebateByTotal($totalPrice, $orderTime);
            if ($rebateEvent != null) {
                $this->addRebateCorrespondByOidAndReid($oid, $rebateEvent->reid);
                $totalPrice = $totalPrice - $rebateEvent->price;
            }
            $this->refreshEcouponByOrderTime($orderTime);
            $ecouponPrice = $this->getEcouponPriceByCouponCode($couponCode, $orderTime);
            if ($ecouponPrice > 0) {
                if ($ecouponPrice > $totalPrice) {
                    $totalPrice = 0;
                } else {
                    $totalPrice = $totalPrice - $ecouponPrice;
                }
                $this->addEcouponCorrespondByOidAndPrice($oid, $ecouponPrice);
                $this->deleteEcouponByCouponCode($couponCode);
            }
            $totalPriceData = array('totalPrice' => $totalPrice);
            $this->db->where('oid', $oid);
            $this->db->update('ordersummary', $totalPriceData);
            $this->ShoppingCartModel->clearShoppingCart($mid);
            $this->sendInformMail($mid, $oid);
        }
        $this->db->trans_complete();
    }

    public function getEcouponPriceByCouponCode($couponCode, $orderTime)
    {
        $this->db->select('price');
        $this->db->from('ecoupon');
        $this->db->where('couponCode', $couponCode);
        //$this->db->where('startTime >=', $orderTime);
        //$this->db->where('endTime <=', $orderTime);
        $data = $this->db->get();
        $dataResult = $data->result();
        $price = 0;
        if ($data->num_rows() > 0) {
            $price = $dataResult[0]->price;
        }
        return $price;
    }

    public function addEcouponCorrespondByOidAndPrice($oid, $price)
    {
        $data = array('oid' => $oid, 'price' => $price);
        $this->db->insert('ecouponcorrespond', $data);
    }

    public function deleteEcouponByCouponCode($couponCode)
    {
        $this->db->where('couponCode', $couponCode);
        $this->db->delete('ecoupon');
    }

    public function refreshEcouponByOrderTime($orderTime)
    {
        $this->db->where('endTime <', $orderTime);
        $this->db->delete('ecoupon');
    }

    public function getOrderTimeByOid($oid)
    {
        $this->db->select('orderTime');
        $this->db->from('ordersummary');
        $this->db->where('oid', $oid);
        $dataResult = $this->db->get()->result();
        $orderTime = $dataResult[0]->orderTime;
        return $orderTime;
    }

    public function setOrderItemByOidAndCartData($oid, $shoppingCartData)
    {
        foreach ($shoppingCartData->result() as $cartRow) {
            $orderTime = $this->getOrderTimeByOid($oid);
            $discountEvent = $this->getBestDiscountByBid($cartRow->bid, $orderTime);
            if ($discountEvent != null) {
                $this->addDiscountCorrespondByOidAndBid($oid, $cartRow->bid, $discountEvent->
                    deid);
            }
            $cartQuantity = $cartRow->quantity;
            $stockData = $this->getStockDataByBid($cartRow->bid);
            while ($cartQuantity > 0) {
                foreach ($stockData->result() as $stockRow) {
                    $stockRestAmount = $stockRow->restAmount;
                    if ($stockRestAmount >= $cartQuantity) {
                        $this->modifyStockRestAmountBySrid($stockRow->srid, $stockRestAmount - $cartQuantity);
                        $orderItemCostQuantity = $this->getOrderItemQuantityByCost($oid, $cartRow->bid,
                            $stockRow->price);
                        if ($orderItemCostQuantity > 0) {
                            $this->modifyOrderItemQuantityByOidAndBidAndCost($oid, $cartRow->bid, $cartQuantity +
                                $orderItemCostQuantity, $stockRow->price);
                        } else {
                            $this->addOrderItemByOidAndBid($oid, $cartRow->bid, $cartQuantity, $stockRow->
                                price);
                        }
                        $cartQuantity = 0;
                        break 2;
                    } else {
                        $cartQuantity = $cartQuantity - $stockRestAmount;
                        $this->modifyStockRestAmountBySrid($stockRow->srid, 0);
                        $orderItemCostQuantity = $this->getOrderItemQuantityByCost($oid, $cartRow->bid,
                            $stockRow->price);
                        if ($orderItemCostQuantity > 0) {
                            $this->modifyOrderItemQuantityByOidAndBidAndCost($oid, $cartRow->bid, $stockRow->
                                restAmount + $orderItemCostQuantity, $stockRow->price);
                        } else {
                            $this->addOrderItemByOidAndBid($oid, $cartRow->bid, $stockRow->restAmount, $stockRow->
                                price);
                        }
                    }
                }
            }
        }
    }

    public function modifyStockRestAmountBySrid($srid, $quantity)
    {
        $stockRecordData = array('restAmount' => $quantity);
        $this->db->where('srid', $srid);
        $this->db->update('stockrecord', $stockRecordData);
    }

    public function modifyOrderItemQuantityByOidAndBidAndCost($oid, $bid, $quantity,
        $cost)
    {
        $orderItemData = array('quantity' => $quantity);
        $this->db->where('oid', $oid);
        $this->db->where('bid', $cartRow->bid);
        $this->db->where('cost', $cost);
        $this->db->update('orderitem', $orderItemData);
    }

    public function addOrderItemByOidAndBid($oid, $bid, $quantity, $cost)
    {
        $time = $this->getOrderTimeByOid($oid);
        $orderItemData = array('oid' => $oid, 'bid' => $bid, 'soldPrice' => $this->
            getSoldPriceByBidAndTime($bid, $time), 'quantity' => $quantity, 'cost' => $cost);
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
        if ($data->num_rows() > 0) {
            $quantity = $dataResult[0]->quantity;
        } else {
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
        if ($totalPriceData->num_rows() > 0) {
            $totalPrice = $totalPriceDataResult[0]->totalPrice;
        } else {
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

    public function getSoldPriceByBidAndTime($bid, $time)
    {
        $this->db->select('price');
        $this->db->from('book');
        $this->db->where('bid', $bid);
        $dataResult = $this->db->get()->result();
        $soldPrice = $dataResult[0]->price;
        $discountEvent = $this->getBestDiscountByBid($bid, $time);
        $discountRate = 1;
        if ($discountEvent != null) {
            $discountRate = $discountEvent->discount_rate;
        }
        $soldPrice = $soldPrice * $discountRate;
        return $soldPrice;
    }

    public function getBestRebateByTotal($afterDiscountTotal, $time)
    {
        $this->db->select('reid, name, threshold, price'); //
        $this->db->from('rebateevent'); //
        $this->db->where('threshold <=', $afterDiscountTotal);
        $this->db->where("startTime <=", $time);
        $this->db->where("endTime >=", $time);
        $list = $this->db->get()->result();
        $count = count($list);
        $rebateEvent = null;
        if ($count > 0) {
            for ($maxDiscountIndex = 0, $i = 0; $i < $count; $i++) {
                if ($list[$i]->price > $list[$maxDiscountIndex]->price) {
                    $maxDiscountIndex = $i;
                }
            }
            $reid = $list[$maxDiscountIndex]->reid;
            $price = $list[$maxDiscountIndex]->price;
            $rebateEvent = $list[$maxDiscountIndex];
        }
        return $rebateEvent;
    }

    public function getBestDiscountByBid($bid, $time)
    {
        $this->db->select('de.deid, de.name, de.discount_rate'); //
        $this->db->from('categorycorrespond as cc, discountevent as de'); //
        $this->db->where("cc.cid = de.cid AND cc.bid = $bid");
        $this->db->where("de.startTime <=", $time);
        $this->db->where("de.endTime >=", $time);
        $list = $this->db->get()->result();
        $count = count($list);
        $discountEvent = null;
        if ($count > 0) {
            for ($minDiscountIndex = 0, $i = 0; $i < $count; $i++) {
                if ($list[$i]->discount_rate < $list[$minDiscountIndex]->discount_rate) {
                    $minDiscountIndex = $i;
                }
            }
            $deid = $list[$minDiscountIndex]->deid;
            $discount = $list[$minDiscountIndex]->discount_rate;
            $discountEvent = $list[$minDiscountIndex];
        }
        return $discountEvent;
    }

    public function addDiscountCorrespondByOidAndBid($oid, $bid, $deid)
    {
        $data = array('oid' => $oid, 'bid' => $bid, 'deid' => $deid);
        $this->db->insert('discountcorrespond', $data);
    }

    public function addRebateCorrespondByOidAndReid($oid, $reid)
    {
        $data = array('oid' => $oid, 'reid' => $reid);
        $this->db->insert('rebatecorrespond', $data);
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
        $stockQuantity = 0;
        if ($data->num_rows() > 0) {
            $stockQuantity = $dataResult[0]->totalQuantity;
        } else {
            $stockQuantity = 0;
        }
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
        if ($this->getStockByBid($bid) >= $quantity) {
            return true;
        } else {
            return false;
        }
    }

    public function IsAllStockEnough($mid)
    {
        $stockEnough = true;
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        foreach ($shoppingCartData->result() as $row) {
            $stockEnough = $stockEnough && $this->isStockEnough($row->bid, $row->quantity);
            if (!$this->isStockEnough($row->bid, $row->quantity)) {
                $this->ShoppingCartModel->modifyShoppingCart($mid, $row->bid, 0);
            }
        }
        return $stockEnough;
    }

    public function resetShoppingCartQuantityFromTransactionErrorByMid($mid)
    {
        $shoppingCartData = $this->getShoppingCartDataByMid($mid);
        foreach ($shoppingCartData->result() as $row) {
            if ($row->quantity > 0) {
                $this->ShoppingCartModel->modifyShoppingCart($mid, $row->bid, 0);
            } else {
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
    
    public function getDiscountEventFromDiscountCorrespondByOidAndBid($oid, $bid)
    {
        $this->db->select('de.name, de.discount_rate');
        $this->db->from('discountcorrespond as dc, discountevent as de');
        $this->db->where("dc.oid = $oid AND dc.bid = $bid AND dc.deid = de.deid");
        $dataResult = $this->db->get()->result();
        if(count($dataResult) > 0)
        {
            return $dataResult[0];
        }
        else
        {
            return null;
        }
    }
    
    public function getRebateEventFromRebateCorrespondByOid($oid)
    {
        $this->db->select('re.name, re.price');
        $this->db->from('rebateCorrespond as rc, rebateevent as re');
        $this->db->where("rc.oid = $oid AND rc.reid = re.reid");
        $dataResult = $this->db->get()->result();
        if(count($dataResult) > 0)
        {
            return $dataResult[0];
        }
        else
        {
            return null;
        }
    }
    
    public function getEcouponPriceFromEcouponCorrespondByOid($oid)
    {
        $this->db->select('price');
        $this->db->from('ecouponcorrespond');
        $this->db->where('oid', $oid);
        $dataResult = $this->db->get()->result();
        if(count($dataResult) > 0)
        {
            return $dataResult[0]->price;
        }
        else
        {
            return 0;
        }
    }
    
    public function getOrderSummaryPriceByOid($oid)
    {
        $this->db->select('totalPrice');
        $this->db->from('ordersummary');
        $this->db->where('oid', $oid);
        $dataResult = $this->db->get()->result();
        return $dataResult[0]->totalPrice;
    }

    public function sendInformMail($mid, $oid)
    {
        $recipient = $this->AccountModel->getEmailByMid($mid);
        $orderItemData = $this->getOrderItemDataByOid($oid);
        $orderItemString = "";
        $sumOfSubTotal = 0;
        $divider = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\r\n";
        foreach ($orderItemData->result() as $row)
        {
            $sumOfSubTotal = $sumOfSubTotal + $row->quantity * $row->soldPrice;
            // 判斷是否使用過discount event
            $discountEvent = $this->getDiscountEventFromDiscountCorrespondByOidAndBid($oid, $row->bid);
            $discountEventString = "";
            if($discountEvent != null)
            {
                $discount = $discountEvent->discount_rate * 10;
                $discountEventString = "\r\n[折扣活動][$discountEvent->name][$discount" . "折]";
            }
            $orderItemString = $orderItemString . $divider . "書名: " . $row->name . $discountEventString . "\r\n售價: " . $row->soldPrice . "   " . "購買數量: " . $row->quantity . "   " . "小計: " . $row->soldPrice * $row->quantity . "\r\n";
        }
        $sumOfSubTotal = "小計總和： " . $sumOfSubTotal;
        // 判斷是否使用過rebate event
        $rebateEvent = $this->getRebateEventFromRebateCorrespondByOid($oid);
        $rebateEventString = "";
        if($rebateEvent != null)
        {
            $rebateEventString = "\r\n[折價活動][$rebateEvent->name][減價$rebateEvent->price" . "元]";
        }
        // 判斷是否使用過ecoupon
        $ecouponPrice = $this->getEcouponPriceFromEcouponCorrespondByOid($oid);
        $ecouponString = "";
        if($ecouponPrice > 0)
        {
            $ecouponString = "\r\n[酷碰券][減價$ecouponPrice" . "元]";
        }
        $totalPrice = $this->getOrderSummaryPriceByOid($oid);
        $totalString = "\r\n總計： $totalPrice 元";
        $subject = 'TaipeiTech Store';
        $name = $this->AccountModel->getNameByMid($mid);
        $message = "親愛的$name" . "您好,"  . "\r\n" . "您的訂單已收到, 正在處理中" . "\r\n\r\n" . "訂單編號: " . $oid . "\r\n" . $orderItemString . $sumOfSubTotal . $rebateEventString . $ecouponString . $totalString;
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }

    public function sendThanksMail($mid, $oid)
    {
        $recipient = $this->AccountModel->getEmailByMid($mid);
        $orderItemData = $this->getOrderItemDataByOid($oid);
        $orderItemString = "";
        $sumOfSubTotal = 0;
        $divider = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\r\n";
        foreach ($orderItemData->result() as $row)
        {
            $sumOfSubTotal = $sumOfSubTotal + $row->quantity * $row->soldPrice;
            // 判斷是否使用過discount event
            $discountEvent = $this->getDiscountEventFromDiscountCorrespondByOidAndBid($oid, $row->bid);
            $discountEventString = "";
            if($discountEvent != null)
            {
                $discount = $discountEvent->discount_rate * 10;
                $discountEventString = "\r\n[折扣活動][$discountEvent->name][$discount" . "折]";
            }
            $orderItemString = $orderItemString . $divider . "書名: " . $row->name . "\r\n" . "售價: " . $row->soldPrice . "\r\n" . "購買數量: " . $row->quantity . "\r\n"; 
        }
        $sumOfSubTotal = "小計總和： " . $sumOfSubTotal;
        // 判斷是否使用過rebate event
        $rebateEvent = $this->getRebateEventFromRebateCorrespondByOid($oid);
        $rebateEventString = "";
        if($rebateEvent != null)
        {
            $rebateEventString = "\r\n[折價活動][$rebateEvent->name][減價$rebateEvent->price" . "元]";
        }
        // 判斷是否使用過ecoupon
        $ecouponPrice = $this->getEcouponPriceFromEcouponCorrespondByOid($oid);
        $ecouponString = "";
        if($ecouponPrice > 0)
        {
            $ecouponString = "\r\n[酷碰券][減價$ecouponPrice" . "元]";
        }
        $totalPrice = $this->getOrderSummaryPriceByOid($oid);
        $totalString = "\r\n總計： $totalPrice 元";
        $subject = 'TaipeiTech Store';
        $name = $this->AccountModel->getNameByMid($mid);
        $message = "親愛的$name" . "您好," . "\r\n" . "您的訂單已送達" . "\r\n\r\n" . "訂單編號: " . $oid . "\r\n" . $orderItemString . $sumOfSubTotal . $rebateEventString . $ecouponString . $totalString . "\r\n" . $divider . "\r\n謝謝您的訂購.";
        $this->GmailModel->sendMail($recipient, $subject, $message);
    }

    public function getNotEnoughBookStockQuantity($originalShoppingCartList)
    {
        $list = array();
        foreach ($originalShoppingCartList as $book) {
            $restStockQuantity = $this->getStockByBid($book->bid);
            if ($restStockQuantity < $book->quantity) {
                $bookData = $this->BookModel->getBookDataByBid($book->bid);
                array_push($list, array("name" => $bookData->name, "ISBN" => $bookData->ISBN,
                    "quantity" => $restStockQuantity));
            }
        }
        return $list;
    }
}

?>