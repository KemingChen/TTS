<?php
    echo 'total_num_rows '.$total_num_rows.'<br>';
    
    foreach ($books as $book)
    {
        echo '<input type="button" value= detail onclick="browse('.$book->bid.')">'; 
        echo " bid:" . $book->bid;
        echo " name: " . $book->name;
        echo '<img width= "20px" height="20px" src="data:image/jpeg;base64,'.base64_encode($book->cover).'" alt="photo"><br/>';
        echo '<br/>';
    }
?>
<script type="text/javascript">
function browse(bid)
{
    window.location = '/TTS/Book/Browse/'+bid;
}
</script>

