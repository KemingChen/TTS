
size = <?= $num ?>      <br />
size = <?= $totalNum ?> <br />

<?php foreach ($books->result() as $book): ?>
    <?=$book->bid?>
<?php endforeach ?>

<br />
<br />
<a href="/TTS/announcement/create">Add</a>