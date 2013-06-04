<?php

class Stock extends CI_Controller
{
    public function browseBooksStock()
    {
        $this->load->model('StockModel');
        $query = $this->StockModel->browseBooksStock();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "name: " . $row->name;
                echo ", stock: " . $row->stock . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "There's no any record!";  
        }
    }
    
    public function browseStockRecord()
    {
        $this->load->model('StockModel');
        $query = $this->StockModel->browseStockRecord();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                echo "srid: " . $row->srid;
                echo ", bid: " . $row->bid;
                echo ", price: " . $row->price;
                echo ", amount: " . $row->amount;
                echo ", restAmount: " . $row->restAmount;
                echo ", stockTime: " . $row->stockTime . "<br />";
            }
            echo "<br />";
        }
        else
        {
            echo "There's no any record!";  
        }
        
    }
    
    public function addStockRecord()
    {
        $this->load->model('StockModel');
        $bid = 1;
        $price = 2000;
        $amount = 23;
        $restAmount = 12;
        $stockTime = '2013/1/1';
        $this->StockModel->addStockRecord($bid, $price, $amount, $restAmount, $stockTime);
    }    
}


?>