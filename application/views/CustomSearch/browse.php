<?php 
    echo "size is " . sizeof($records->result()) . "<br />";
    foreach ($records->result() as $row)
    {
        echo "bid:" . $row->bid;
        //echo ", name: " . iconv("UTF-8","big5",$row->name);
        //echo ", author: " . iconv("UTF-8","big5",$row->author);
        echo ", name: " . $row->name;
        echo ", author: " . $row->author;
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row->cover).'" alt="photo">';
        echo ", publisher: " . $row->publisher;
        //echo ", publisher: " . iconv("UTF-8","big5",$row->publisher);
        echo ", publishedDate: " . $row->publishedDate;
        echo ", price: " . $row->price;
        echo ", ISBN: " . $row->ISBN;
        echo ", onshelf: " . $row->onShelf . "<br />";
    }
?>

