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
			<table class="table">
				<thead>
					<tr>
						<th>交易編號</th>
						<th>購買時間</th>
						<th>交易狀態</th>
						<th>金額</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $isInfo = FALSE;
                    foreach($list->result() as $record)
                    {
                        if($isInfo){
                            echo '<tr class="info"><td>';
                        }
                        else
                        {
                            echo "<tr><td>";
                        }
                        $isInfo = ! $isInfo;
                        echo $record->oid;							
    					echo "</td><td>";
                        echo $record->orderTime;
    					echo "</td><td>";
                        echo $record->state; 
    					echo "</td><td>";
                        echo $record->totalPrice;
    					echo "</td><td>";
                        echo '<button type="button" class="btn btn-mini btn-info" onclick="showRecordInfo('. $record->oid .')">詳細資料</button>';
                        echo "</td></tr>";
                    }
                    ?>
				</tbody>
			</table>
			<div class="pagination pagination-centered">
				<ul>
					<li>
						<a href="#">Prev</a>
					</li>
					<li>
						<a href="#">1</a>
					</li>
					<li>
						<a href="#">2</a>
					</li>
					<li>
						<a href="#">3</a>
					</li>
					<li>
						<a href="#">4</a>
					</li>
					<li>
						<a href="#">5</a>
					</li>
					<li>
						<a href="#">Next</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>