query row number = <?= $num_rows ?>      <br />
total row number = <?= $total_NumRows ?> <br /><br /><br /><br />
<?php 
    //echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($cart->result() as $row)
    {
        echo "mid:" . $row->mid;
        echo "quantity: " . $row->quantity;
        echo "bid:" . $row->bid;
        echo "name;" . $row->name;
        echo "isbn:" . $row->isbn;
        echo "price:" . $row->price . "<br />";
    }
?>