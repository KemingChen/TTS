<?php foreach ($annoucements->result() as $item): ?>

    <?php echo $item->adid ?>
    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item->picture).'" alt="photo">'?>
    <?php echo $item->description ?>
    <br />
<?php endforeach ?>

<br />
<br />
<a href="/TTS/announcement/create">Add</a>