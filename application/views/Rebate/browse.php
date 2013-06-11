<?php 
    echo "size is " . sizeof($rebate->result()) . "<br />";
    foreach ($rebate->result() as $row)
    {
        echo "reid:" . $row->reid;
        echo ", name: " . $row->name;
        echo ", startTime: " . $row->startTime;
        echo ", endTime: " . $row->endTime;
        echo ", threshold: " . $row->threshold;
        echo ", price: " . $row->price . "<br />";
    }
?>