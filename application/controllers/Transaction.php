<?php

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model("TransactionModel");
        $this->load->model("ShoppingCartModel");
    }
    
    public function index(){
        echo "hello account";
    }
    
    public function manageOrderState($oid, $state)
    {
        $this->TransactionModel->manageOrderState($oid, $state);
        $this->browseManageOrder();
    }
    
    public function browseManageOrder()
    {
        $data['transaction'] = $this->TransactionModel->BrowseManageOrder();
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseManageOrder', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseArrivedOrder()
    {
        $data['transaction'] = $this->TransactionModel->getArrivedOrder();
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecords', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecords()
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecords();
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecords', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByTimeInterval($start, $end)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByTimeInterval($start, $end);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecords', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByState($state)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByState($state);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecords', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByLimit($start, $length)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByLimit($start, $length);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecords', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByMid($mid)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByMid($mid);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecordsByMid', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByTimeIntervalById($mid, $start, $end)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByTimeIntervalById($mid, $start, $end);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecordsByMid', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseTransactionRecordsByStateByMid($mid, $state)
    {
        $data['transaction'] = $this->TransactionModel->browseTransactionRecordsByStateByMid($mid, $state);
        if($data['transaction']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseTransactionRecordsByMid', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function browseOrderItemsByOid($oid)
    {
        $data['orderItems'] = $this->TransactionModel->getOrderItemDataByOid($oid);
        $data['oid'] = $oid;
        if($data['orderItems']->num_rows() > 0)
        {
            $this->load->view('Transaction/BrowseOrderItems', $data);
        }
        else
        {
            show_error("no data");
        }
    }
    
    public function cancelTheTransaction($oid)
    {
        $this->TransactionModel->cancelTheTransaction($oid);
        $this->browseManageOrder();
    }
    
    public function order($mid, $couponCode="")
    {
        $originalShoppingCartData = $this->TransactionModel->getShoppingCartDataByMid($mid);
        $stockEnough = false;
        $stockEnough = $this->TransactionModel->IsAllStockEnough($mid);
        if($stockEnough)
        {
            $datestring = "%Y-%m-%d";
            $now = now();
            $now = mdate($datestring, $now);
            $data = array(
                            'mid' => $mid,
                            'orderTime' => $now,
                            'state' => 'processing'
            );
            $this->TransactionModel->order($mid, $data, $couponCode);
            $this->browseTransactionRecordsByMid($mid);
        }
        else
        {
            $this->TransactionModel->resetShoppingCartQuantityFromTransactionErrorByMid($mid);
            $ShoppingCartData['restQuantity'] = $this->TransactionModel->getRestQuantityShoppingCartData($mid);
            $result = count($ShoppingCartData['restQuantity']);
            $this->ShoppingCartModel->clearShoppingCart($mid);
            $ShoppingCartData['mid'] = $mid;
            $this->load->view('Transaction/TransactionFail', $ShoppingCartData);
            foreach($originalShoppingCartData->result() as $row)
            {
                $this->ShoppingCartModel->addShoppingCart($mid, $row->bid, $row->quantity);
            }
        }
    }
}

?>