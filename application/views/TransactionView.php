<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>交易紀錄</h3>
            <script>
                function showRecordInfo(oid)
                {
                    console.log(oid);
                    $("#windowTitle").html('');
                    $("#transactionDetail").html('Loading...^^');
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
            <?php if($list->num_rows()==0){ ?>
            交易記錄是空的，快來看看有什麼<a href="">新書</a>！
            <?php }else{ ?>
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
    					echo "</td><td><span class='label label-info'>";
                        echo $record->state; 
    					echo "</span></td><td>";
                        echo $record->totalPrice;
    					echo "</td><td>";
                        echo '<button type="button" class="btn btn-mini btn-info" onclick="showRecordInfo('. $record->oid .')">詳細資料</button>';
                        echo "</td></tr>";
                    }
                    ?>
				</tbody>
			</table>
            <div class="pagination" align="center">
                <ul>    
                <?php
                    $url = base_url("ViewMember/Me/Transaction")."/";
                    $page-1 >= 1 ? PrintPageliTag("Prev", $url.($page-1)) : "";
                    for($i=1;$i<=$pages;$i++)
                    {
                        PrintPageliTag($i, $url.$i, $i==$page ? "active" : "");
                    }
                    $page+1 <= $pages ? PrintPageliTag("Next", $url.($page+1)) : "";
                ?>
                </ul>
            </div>
			<?php }
                function PrintPageliTag($word, $url, $active = "")
                {
                    echo "<li class='$active'><a href='$url'>$word</a></li>";
                }  
            ?>
		</div>
	</div>
</div>