<?php

    echo 'total_num_rows'.$total_num_rows.'<br/><br/><br/>';
    
    foreach ($books as $book)
    {
        print_r($book);
        echo '<br/>';
    }
?>