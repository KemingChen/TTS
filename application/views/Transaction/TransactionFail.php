<?php echo "mid: " . $mid . "<br/>" ?>
<?php foreach ($restQuantity->result() as $row): ?>
<?php echo "book name: " . $row->name . " " ?>
<?php echo "rest quantity: " . $row->quantity . "<br/>" ?>
<?php endforeach ?>