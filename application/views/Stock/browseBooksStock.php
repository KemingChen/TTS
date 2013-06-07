<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "name:" . $row->name;
        echo ", stock: " . $row->stock . "<br />";
    }
?>

