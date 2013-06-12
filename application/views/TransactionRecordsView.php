<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
        
        <?php
        if (count($list) <= 0) {?>
        <div>
            <h3>沒有任何訂單。</h3>
        </div>
        <?
        } else {
        ?>
			<table class="table">
				<thead>
					<tr>
						<th>
							交易編號
						</th>
						<th>
							會員編號
						</th>
						<th>
							購買時間
						</th>
						<th>
							交易狀態
						</th>
						<th>
							金額
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = false;
                    foreach ($list as $orderSummary) {
                        if ($isSuccess) {
                            echo '<tr class="success">';
                        } else {
                            echo "<tr>";
                        }
                        $isSuccess = !$isSuccess;
                ?>
						<td>
							<?= $orderSummary->oid ?>
						</td>
						<td>
							<?= $orderSummary->mid ?>
						</td>
						<td>
							<?= $orderSummary->orderTime ?>
						</td>
						<td>
							<?= $orderSummary->state ?>
						</td>
						<td>
							<?= $orderSummary->totalPrice ?>
						</td>
                <?php
    }
?>
				</tbody>
			</table>
            <?php
}
?>
            <?=$pagination?>
		</div>
	</div>
</div>