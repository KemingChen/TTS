<script>
function stock(bid){
    
    quantity = $("#quantity" + bid).val();
    if(quantity==""){
        showReminderMsg("數量欄位請輸入數字");
    }else if(quantity<1){
        showReminderMsg("數量欄位至少進貨一本");
    }else{
        
        cost = $("#cost" + bid).val();
        if(cost==""){
            showReminderMsg("單價欄位請輸入數字");
        }else if(cost<0){
            showReminderMsg("單價欄位不能輸入負數");
        }else{
            cost = parseInt(cost, 10);
            quantity = parseInt(quantity, 10);
            console.log("quantity=" + quantity + ", cost=" + cost);
            
            $.ajax({url: "<?= base_url("Stock/addStockRecord") ?>/" + bid + "/" + cost + "/" + quantity}).
                done(function(data){
                    showReminderMsg("成功進貨。");
                    location.reload();
                });  
        }
    }
}
</script>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							BID
						</th>
						<th>
							ISBN
						</th>
						<th>
							書名
						</th>
						<th>
							數量
						</th>
						<th>
							單價
						</th>
						<th>
							
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
$isSuccess = false;
foreach ($list as $book) {
    if ($isSuccess) {
        echo '<tr class="success">';
    } else {
        echo "<tr>";
    }
    $isSuccess = !$isSuccess;
?>
						<td>
							<?= $book->bid ?>
						</td>
						<td>
							<?= $book->ISBN ?>
						</td>
						<td>
                            <?= $book->name ?>
						</td>
						<td>
                            <input type="number" id="quantity<?=$book->bid?>"/>
						</td>
						<td>
                            <input type="number" id="cost<?=$book->bid?>"/>
						</td>
						<td>
                            <button type="button" class="btn btn-info" onclick="stock(<?=$book->bid?>);">進貨</button>
						</td>
                <?php
}
?>
				</tbody>
			</table>
            <?= $pagination ?>
		</div>
	</div>
</div>