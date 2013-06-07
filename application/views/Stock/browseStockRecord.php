<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "srid:" . $row->srid;
        echo ", bid: " . $row->bid;
        echo ", price: " . $row->price;
        echo ", amount: " . $row->amount;
        echo ", restAmount: " . $row->restAmount;
        echo ", stockTime: " . $row->stockTime . "<br />";
    }
?>

