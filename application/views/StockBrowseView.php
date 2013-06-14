<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>瀏覽庫存資料</h3>
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
                    <div class="container-fluid">
                    	<div class="row-fluid">
                    		<div id="transactionDetail">
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
							進貨編號
						</th>
						<th>
							ISBN
						</th>
						<th>
							書名
						</th>
						<th>
							進貨時間
						</th>
						<th>
							進貨數量
						</th>
						<th>
							剩餘數量
						</th>
						<th>
							成本
						</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
                <?php
                $isSuccess = false;
                foreach ($list as $stockRecord) {
                    if ($isSuccess) {
                        echo '<tr class="success">';
                    } else {
                        echo "<tr>";
                    }
                    $isSuccess = !$isSuccess;
                ?>
					<td width="8%">
						<?= $stockRecord->srid ?>
					</td>
					<td width="10%">
						<?= $stockRecord->ISBN ?>
					</td>
					<td>
						<?= $stockRecord->name ?>
					</td>
					<td width="15%">
						<?= $stockRecord->stockTime ?>
					</td>
					<td width="7%">
						<?= $stockRecord->amount ?>
					</td>
					<td width="7%">
						<?= $stockRecord->restAmount ?>
					</td>
					<td width="8%">
						<?= $stockRecord->price ?>
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