<?php 
    echo "size is " . sizeof($ecoupon->result()) . "<br />";
    foreach ($ecoupon->result() as $row)
    {
        echo "ecid:" . $row->ecid;
        echo ", couponCode: " . $row->couponCode;
        echo ", startTime: " . $row->startTime;
        echo ", endTime: " . $row->endTime;
        echo ", price: " . $row->price . "<br />";
    }
?>