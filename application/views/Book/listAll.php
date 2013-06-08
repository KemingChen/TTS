<?php 
    echo 'num_rows'.$data['num_rows'].'<br/>';
    echo 'total_num_rows'.$data["total_NumRows"].'<br/><br/><br/>';
    
    foreach ($data['books'] as $book)
    {
        echo '<input type="button" value= detail onclick="browse('.$book->bid.')">'; 
        echo " bid:" . $book->bid;
        echo " name: " . $book->name;
        echo '<img width= "20px" height="20px" src="data:image/jpeg;base64,'.base64_encode($book->cover).'" alt="photo"><br/>';
    }
    
    echo '<br/><a href="/TTS/Book/Create">Create</a>  ';
    echo '<br/>book id <input type="input" id="input_book_id">';
    echo ' cateogry id <input type="input" id="input_category_id">';
    echo '<input type="button" onclick="insertCategory()" value="insertCategory">';
    
    echo '<br/>book id <input type="input" id="input_writer_book_id">';
    echo ' writer id <input type="input" id="input_writer_id">';
    echo '<input type="button" onclick="insertWriter()" value="insertWriter">';
    
    echo '<br/>book id <input type="input" id="input_translator_book_id">';
    echo ' translator id <input type="input" id="input_translator_id">';
    echo '<input type="button" onclick="insertTranslator()" value="insertTranslator">';
    
?>

<script type="text/javascript">
function browse(bid)
{
    window.location = '/TTS/Book/Browse/'+bid;
}
function insertCategory()
{
    var bid = $("#input_book_id").val();
    var cid = $("#input_category_id").val();
    window.location = '/TTS/Book/InsertCategory/'+bid+'/'+cid; 
}
function insertWriter()
{
    var bid = $("#input_writer_book_id").val();
    var cid = $("#input_writer_id").val();
    window.location = '/TTS/Book/insertWriter/'+bid+'/'+cid; 
}
function insertTranslator()
{
    var bid = $("#input_translator_book_id").val();
    var cid = $("#input_translator_id").val();
    window.location = '/TTS/Book/insertTranslator/'+bid+'/'+cid; 
}
</script>

