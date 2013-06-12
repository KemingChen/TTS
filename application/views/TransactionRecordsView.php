<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>交易紀錄</h3>
            <script>
                function showRecordInfo(oid)
                {
                    console.log(oid);
                    $("#recordinfo").modal('show');
                    
                    $.ajax({url: "<?= base_url("ViewMember/getTransactionTitle") ?>/"+oid}).
                        done(function(data){
                            $("#windowTitle").html(data);
                        });
                    
                    $.ajax({url: "<?= base_url("ViewMember/getTransactionDetailView") ?>/"+oid}).
                        done(function(data){
                            $("#transactionDetail").html(data);
                        });
                }
            </script>
            <div id="recordinfo" class="modal hide fade in">
                <div class="modal-header">
                    <h3 id="windowTitle">交易明細(2 at 2013-06-22 state asasfd)</h3>
                </div>
                <div class="modal-body">
                    <h4 class="red" align="center">顯示多筆交易資料<h4>
                    <div class="container-fluid">
                    	<div class="row-fluid">
                    		<div class="span10" id="transactionDetail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">關閉</button>
                </div>
            </div>
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
                        <th></th>
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
                        <td>
                            <button type="button" class="btn btn-mini btn-info" onclick="showRecordInfo(<?=$orderSummary->oid?>)">詳細資料</button>
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