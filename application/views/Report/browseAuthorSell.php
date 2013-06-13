<?php 
    echo "size is " . sizeof($report->result()) . "<br />";
    foreach ($report->result() as $row)
    {
        echo "authorName:" . $row->name;
        echo ", profit: " . $row->profit;
        echo ", quantity: " . $row->quantity . "<br />";
    }
?>