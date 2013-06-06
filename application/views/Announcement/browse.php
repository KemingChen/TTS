
size = <?= $size ?><br />
<?php foreach ($announcements->result() as $item): ?>

    <?php echo $item->adid ?>
    <a href="/TTS/announcement/delete/<?php echo $item->adid?>">delete</a>
    <a href="/TTS/announcement/update/<?php echo $item->adid?>">update</a>
    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item->picture).'" alt="photo">'?>
    <?php echo $item->description ?>
    <br />
<?php endforeach ?>

<br />
<br />
<a href="/TTS/announcement/create">Add</a>