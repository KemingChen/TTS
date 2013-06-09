<?php

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model("TransactionModel");
    }
    
    public function index(){
        echo "hello account";
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
        $data['orderItems'] = $this->TransactionModel->browseOrderItemsByOid($oid);
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
        $this->browseTransactionRecords();
    }
    
    public function order($mid)
    {
        $datestring = "%Y-%m-%d";
        $now = now();
        $now = mdate($datestring, $now);
        $data = array(
                        'mid' => $mid,
                        'orderTime' => $now,
                        'state' => 'processing'
        );
        $this->TransactionModel->order($mid, $data);
        $this->browseTransactionRecords();
    }
}

?>