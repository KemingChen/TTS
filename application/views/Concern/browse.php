
query row number = <?= $num_rows ?>      <br />
total row number = <?= $total_NumRows ?> <br /><br /><br /><br />

<?php foreach ($books->result() as $book): ?>
    <?=$book->bid?>
    <a href="/TTS/Concern/DeleteBook/1/<?=$book->bid?>">Delete</a>
    <?=$book->name?>
    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($book->cover).'" alt="photo">'?>
   <br />
   <br />
<?php endforeach ?>

<br />
<br />
<!--mid =1 ,bid =2-->
<a href="/TTS/Concern/AddBook/1/2">Add</a>