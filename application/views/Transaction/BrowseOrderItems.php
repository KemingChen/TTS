<?php echo "oid: " . $oid . "<br/>" ?>
<?php foreach ($orderItems->result() as $row): ?>
<?php echo "book name: " . $row->name . " " ?>
<?php echo "quantity: " . $row->quantity . " " ?>
<?php echo "soldPrice: " . $row->soldPrice . "<br/>" ?>
<?php endforeach ?>