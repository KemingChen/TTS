<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "bid:" . $row->bid;
        echo "name: " . $row->name;
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row->cover).'" alt="photo">';
        echo ", publishedDate: " . $row->publishedDate;
        echo ", price: " . $row->price;
        echo ", ISBN: " . $row->ISBN;
        echo ", onshelf: " . $row->onShelf . "<br />";
    }
?>
