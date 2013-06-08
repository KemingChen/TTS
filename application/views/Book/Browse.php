<?php 
    echo "size is " . sizeof($books->result()) . "<br />";
    foreach ($books->result() as $row)
    {
        echo "bid:" . $row->bid;
        echo ", name: " . $row->name;
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row->cover).'" alt="photo">';
        echo ", author: " . $row->author;
        echo ", publisher: " . $row->publisher;
        echo ", publishedDate: " . $row->publishedDate;
        echo ", price: " . $row->price;
        echo ", ISBN: " . $row->ISBN;
        echo ", onshelf: " . $row->onShelf . "<br />";
    }
?>

