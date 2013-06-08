<?php $result = $phone->result() ?>
<?php echo "mid: " . $result[0]->mid . "<br/>" ?>
<?php echo "size: " . $phone->num_rows() . "<br/>" ?>
<?php foreach ($phone->result() as $row): ?>
<?php echo "phone: " . $row->phoneNumber . "<br/>" ?>
<?php endforeach ?>