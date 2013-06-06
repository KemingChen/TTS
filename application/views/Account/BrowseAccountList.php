<?php foreach ($account->result() as $row): ?>
<a href="/TTS/Account/freeze/<?php echo $row->mid?>">freeze</a>
<a href="/TTS/Account/unfreeze/<?php echo $row->mid?>">unfreeze</a>
<a href="/TTS/Account/modifyAuthority/<?php echo $row->mid?>/administator">editToAdmin</a>
<a href="/TTS/Account/modifyAuthority/<?php echo $row->mid?>/manager">editToManager</a>
<a href="/TTS/Account/modifyAuthority/<?php echo $row->mid?>/customer">editToCustomer</a>
<?php echo "mid: " . $row->mid . " " ?>
<?php echo "email: " . $row->email . " "?>
<?php echo "name: " . $row->name . " " ?>
<?php echo "available: " . $row->available . " " ?>
<?php echo "authority: " . $row->authority . " " ?>
<?php echo "zipCode: " . $row->zipCode . " " ?>
<?php echo "birthday: " . $row->birthday . " " ?>
<?php echo "address: " . $row->address . "<br/>" ?>
<?php endforeach ?>