query row number = <?= $num_rows ?>      <br />
total row number = <?= $total_NumRows ?> <br /><br /><br /><br />
<?php 
    //echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($cart->result() as $row)
    {
        echo "mid:" . $row->mid;
        echo "bid:" . $row->bid;
        echo "quantity: " . $row->quantity;
        $row->name = urldecode($row->name);
        echo "name:" . urldecode($row->name);
        echo "isbn:" . $row->isbn;
        echo "price:" . $row->price . "<br />";
    }
?>