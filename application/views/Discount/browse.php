<?php 
    echo "size is " . sizeof($discount->result()) . "<br />";
    foreach ($discount->result() as $row)
    {
        echo "deid:" . $row->deid;
        echo ", cid:" . $row->cid;
        echo ", name: " . $row->name;
        echo ", startTime: " . $row->startTime;
        echo ", endTime: " . $row->endTime;
        echo ", percentOff: " . $row->percentOff . "<br />";
    }
?>

