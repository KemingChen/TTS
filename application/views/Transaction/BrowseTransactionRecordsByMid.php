<?php $result = $transaction->result() ?>
<?php $oid = $result[0]->oid ?>
<?php echo "mid: " . $result[0]->mid . "<br/>" ?>
<?php foreach ($transaction->result() as $row): ?>
<a href="/TTS/Transaction/browseOrderItemsByOid/<?php echo $row->oid?>">detail</a>
<?php echo "oid: " . $row->oid . " " ?>
<?php echo "orderTime: " . $row->orderTime . " " ?>
<?php echo "state: " . $row->state . " " ?>
<?php echo "totalPrice: " . $row->totalPrice . "<br/>" ?>
<?php endforeach ?>