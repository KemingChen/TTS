<?php

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
    
    public function cancelTheTransaction($oid)
    {
        $this->TransactionModel->cancelTheTransaction($oid);
        $this->browseTransactionRecords();
    }
}

?>