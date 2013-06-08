<?php 

    echo "bid:" . $book->bid.'<br/>';
    echo "name: " . $book->name.'<br/>';
    echo '<img src="data:image/jpeg;base64,'.base64_encode($book->cover).'" alt="photo">'.'<br/>';
    echo "publishedDate: " . $book->publishedDate.'<br/>';
    echo "publisher id: " . $book->pid.'<br/>';
    echo "publisher name: " . $book->pname.'<br/>';
    echo "price: " . $book->price.'<br/>';
    echo "ISBN: " . $book->ISBN.'<br/>';
    echo "description: " . $book->description.'<br/>';
    echo "onshelf: " . $book->onShelf . "<br />";
    
    echo 'cateorgy = ';
    print_r($category);
    echo '<br/>writer = ';
    print_r($writer);
    echo '<br/> translator = ';
    print_r($translator);
    
    echo '<br/><a href="/TTS/book/update/'.$book->bid.'" >Edit</a>';

    echo '<br/>cateogry id <input type="input" id="input_category_id">';
    echo '<input type="button" onclick="insertCategory('.$book->bid.')" value="insertCategory">';
    
    echo '<br/>writer id <input type="input" id="input_writer_id">';
    echo '<input type="button" onclick="insertWriter('.$book->bid.')" value="insertWriter">';
    
    echo '<br/> translator id <input type="input" id="input_translator_id">';
    echo '<input type="button" onclick="insertTranslator('.$book->bid.')" value="insertTranslator">';
    
?>

<script type="text/javascript">
function insertCategory(bid)
{
    var cid = $("#input_category_id").val();
    window.location = '/TTS/Book/InsertCategory/'+bid+'/'+cid; 
}
function insertWriter(bid)
{
    var cid = $("#input_writer_id").val();
    window.location = '/TTS/Book/insertWriter/'+bid+'/'+cid; 
}
function insertTranslator(bid)
{
    var cid = $("#input_translator_id").val();
    window.location = '/TTS/Book/insertTranslator/'+bid+'/'+cid; 
}
</script>