<?php foreach ($transaction->result() as $row): ?>
<a href="/TTS/Transaction/cancelTheTransaction/<?php echo $row->oid?>">delete</a>
<a href="/TTS/Transaction/manageOrderState/<?php echo $row->oid?>/processing">editToProcessing</a>
<a href="/TTS/Transaction/manageOrderState/<?php echo $row->oid?>/shipping">editToShipping</a>
<a href="/TTS/Transaction/manageOrderState/<?php echo $row->oid?>/arrived">editToArrived</a>
<a href="/TTS/Transaction/browseOrderItemsByOid/<?php echo $row->oid?>">detail</a>
<?php echo "oid: " . $row->oid . " " ?>
<?php echo "mid: " . $row->mid . " " ?>
<?php echo "orderTime: " . $row->orderTime . " " ?>
<?php echo "state: " . $row->state . " " ?>
<?php echo "totalPrice: " . $row->totalPrice . "<br/>" ?>
<?php endforeach ?>