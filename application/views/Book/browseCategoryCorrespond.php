<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "bid:" . $row->bid;
        echo "cid:" . $row->cid . "<br />";
    }
?>

