<script>
    function removeShoppingCart(obj, bid)
    {
        console.log(obj);
        $.ajax({url: "<?= base_url("ShoppingCart/removeBook") ?>"+"/"+bid}).
            done(function(data){
                if(data != "OK")
                    alert(data);
                    //document.location.reload();
            });
    }
    
    function ecouponCheck(){
        ecoupon = $("#ecoupon").val();
        notify = $("#notify");
        
        $.ajax({url: "<?=base_url("ECoupon/isExist")?>/" + ecoupon}).
            always(function(data){
                if(data=="OK"){
                    notify.attr("class", "icon-ok icon");
                }else{
                    notify.attr("class", "icon-remove icon-black");
                }
            });
    }
    
    function buy(){
        
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				購物車
			</h3>
            <?php
if ($total_NumRows <= 0) {
?>
            <div>
            購物車沒有任何東西，快來看看有什麼<a href="<?= base_url("Announcement") ?>">新活動</a>！
            </div>
            <?php
} else {
?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ISBN</th>
						<th>書名</th>
						<th>數量</th>
						<th>定價</th>
                        <th>打折</th>
						<th>售價</th>
					</tr>
				</thead>
				<tbody>
                    <?php
    $isInfo = false;

    foreach ($cart as $book) {
        if ($isInfo) {
            echo '<tr class="info"><td>';
        } else {
            echo "<tr><td>";
        }
        $isInfo = !$isInfo;
        echo $book->ISBN;
        echo "</td><td style='width: 30%;'>";
        echo '<a href="' . base_url() . 'ViewBook/book/' . $book->bid . '">' . $book->
            name . "</a>";
        echo "</td><td>";
        echo $book->quantity;
        echo "</td><td>";
        echo $book->price;
        echo "</td><td>";
        echo $book->discountName;
        echo "</td><td>";
        echo $book->soldPrice;
        echo "</td><td>";
        echo '<button type="button" class="btn btn-mini btn-danger" onclick="removeShoppingCart(this, ' .
            $book->bid . ')">取消訂購</button>';
        echo "</td></tr>";
    }
?>
				</tbody>
			</table>
            <div>
                <h3>明細</h3>
                <table class="table">
                    <tr class="warning">
                        <td>打折小計</td>
                        <td><?= $after_discount_total_price ?></td>
                    </tr>
                    <tr class="info">
                        <td>打折內容</td>
                        <td><?= $rebateName ?></td>
                    </tr>
                    <tr class="error">
                        <td>再折</td>
                        <td><?= $rebatePrice ?></td>
                    </tr>
                    <tr class="success">
                        <td>總計</td>
                        <td><?= $totalPrice ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <h3>優惠</h3>
                <label>ECoupon
                <input type="text" id="ecoupon" onchange="ecouponCheck()"/><div class="btn" onclick="ecouponCheck()">檢查</div><i id="notify" class=""></i></label>
                
            </div>
            <div align="center">
                <div class="btn btn-success" onclick="buy()">購買</div>
            </div>
            <?php
            }
            ?>
		</div>
	</div>
</div>