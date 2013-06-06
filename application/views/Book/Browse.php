<?php 
    echo "size is " . sizeof($books->result()) . "<br />";
    foreach ($books->result() as $row)
    {
        echo "bid:" . $row->bid;
        echo "name: " . $row->name;
        echo ", cover: " . $row->cover;
        echo ", publishedDate: " . $row->publishedDate;
        echo ", price: " . $row->price;
        echo ", ISBN: " . $row->ISBN;
        echo ", onshelf: " . $row->onShelf . "<br />";
    }
?>

