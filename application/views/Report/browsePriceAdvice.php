<?php 
    echo "size is " . sizeof($report->result()) . "<br />";
    foreach ($report->result() as $row)
    {
        echo "name:" . $row->name;
        echo "price:" . $row->price;
        echo "cost:" . $row->cost;
        echo "quantity:" . $row->quantity;
        echo "discount_rate:" . $row->discount_rate . "<br />";
    }
?>