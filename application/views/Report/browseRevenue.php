<?php 
    echo "size is " . sizeof($report->result()) . "<br />";
    foreach ($report->result() as $row)
    {
        echo "name:" . $row->name;
        echo ", totalPrice: " . $row->total_price . "<br />";
    }
?>