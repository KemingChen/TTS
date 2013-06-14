<table class="table table-bordered table-condensed">
<thead>
<tr>
<th>ISBN</th>
<th>Name</th>
<th>數量</th>
<th>售價</th>
<th>打折</th>
<th>總價</th>
</tr>
</thead>
<?php
    $after_discount_total_price = 0;
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
        $discountEvent = $this->TransactionModel->getDiscountEventFromDiscountCorrespondByOidAndBid($oid,$orderItem->bid);
        if($discountEvent!=null){
            echo "<td width='10%'>$discountEvent->name</td>";
        }else{
            echo "<td></td>";
        }
        ?>
        <td width="10%"><?= $orderItem->quantity*$orderItem->soldPrice ?></td>
        <?php
        $after_discount_total_price += $orderItem->quantity*$orderItem->soldPrice;
        echo "</tr>";
}
?>
</table>
<div>

<div>
    <h3>明細</h3>
    <table class="table">
        <tr class="warning">
            <td>打折小計</td>
            <td><?= $after_discount_total_price ?></td>
        </tr>
        <?php
        if($rebateEvent!=null){
        ?>
        <tr class="info">
            <td>折價內容</td>
            <td><?= $rebateEvent->name ?></td>
            
        </tr>
        <tr class="error">
            <td>折價</td>
            <td><?= $rebateEvent->price ?></td>
        </tr>
        <tr class="error">
            <td>酷碰券</td>
            <?php
            $ecouponPrice = $this->TransactionModel->getEcouponPriceFromEcouponCorrespondByOid($oid);
            if($ecouponPrice>0){
                echo "<td>$ecouponPrice</td>";
            }else{
                echo "<td>無</td>";
            }
            ?>
        </tr>
        <?php
        }else{
        ?>
        <?php
        }
        ?>
        <tr class="success">
            <td>總計</td>
            <td><?= $orderSummary->totalPrice ?></td>
        </tr>
        <tr>
            <td>狀態</td>
            <td><span class='label label-info'><?=$state?></span></td>
        </tr>
    </table>
</div>