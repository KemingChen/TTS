<?php foreach ($transaction->result() as $row): ?>
<a href="/TTS/Transaction/cancelTheTransaction/<?php echo $row->oid?>">delete</a>
<?php echo "oid: " . $row->oid . " " ?>
<?php echo "mid: " . $row->mid . " " ?>
<?php echo "orderTime: " . $row->orderTime . " " ?>
<?php echo "state: " . $row->state . " " ?>
<?php echo "totalPrice: " . $row->totalPrice . "<br/>" ?>
<?php endforeach ?>