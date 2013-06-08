<?php $result = $transaction->result() ?>
<?php echo "mid: " . $result[0]->mid . "<br/>" ?>
<?php foreach ($transaction->result() as $row): ?>
<?php echo "oid: " . $row->oid . " " ?>
<?php echo "orderTime: " . $row->orderTime . " " ?>
<?php echo "state: " . $row->state . " " ?>
<?php echo "totalPrice: " . $row->totalPrice . "<br/>" ?>
<?php endforeach ?>