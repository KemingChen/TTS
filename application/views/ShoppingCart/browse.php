<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "mid:" . $row->mid;
        echo "bid:" . $row->bid;
        echo "quantity: " . $row->quantity . "<br />";
    }
?>