<table class="table table-bordered table-condensed">
<thead>
<tr>
<th>ISBN</th>
<th>Name</th>
<th>數量</th>
<th>售價</th>
</tr>
</thead>
<?php
    foreach ($list as $orderItem) {
        $isInfo = false;
        if ($isInfo){
            echo '<tr class="info"><td>';
        } else {
            echo "<tr><td>";
        }
        ?>
        <?= $orderItem->ISBN ?></td>
        <td width="65%">
            <a href="<?= base_url("ViewBook/book/$orderItem->bid//0") ?>">
            <?= $orderItem->name ?>
            </a>
        </td>
        <td width="10%"><?= $orderItem->quantity ?></td>
        <td width="10%"><?= $orderItem->soldPrice ?></td>
        <?php
        echo "</tr>";
}
?>
</table>
<h5>State: <span class='label label-info'><?=$state?></span></h5>