<?php 
    echo "size is " . sizeof($report->result()) . "<br />";
    foreach ($report->result() as $row)
    {
        echo "pid:" . $row->pid;
        echo ", publisherName:" . $row->name;
        echo ", profit: " . $row->profit;
        echo ", soldAmount" . $row->sold_amount . "<br />";
    }
?>