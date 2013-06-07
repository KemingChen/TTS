<?php foreach ($account->result() as $row): ?>
<?php echo "email: " . $row->email . " "?>
<?php echo "name: " . $row->name . " " ?>
<?php echo "zipCode: " . $row->zipCode . " " ?>
<?php echo "birthday: " . $row->birthday . " " ?>
<?php echo "address: " . $row->address . "<br/>" ?>
<?php endforeach ?>