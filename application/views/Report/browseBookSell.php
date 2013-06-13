<?php 
    echo "size is " . sizeof($report->result()) . "<br />";
    foreach ($report->result() as $row)
    {
        echo "bookName:" . $row->name;
        echo ", totalQuantity:" . $row->TOTAL_QUANTITY;
        echo ", profit: " . $row->profit . "<br />";
    }
?>