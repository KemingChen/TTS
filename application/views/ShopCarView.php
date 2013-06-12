<script>
    function removeShoppingCart(obj, bid)
    {
        console.log(obj);
        $.ajax({url: "<?=base_url("ShoppingCart/removeBook")?>"+"/"+bid}).
            done(function(data){
                if(data != "OK")
                    alert(data);
                    document.location.reload();
            });
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				購物車
			</h3>
            <?php
            if($total_NumRows<=0){
            ?>
            <div>
            購物車沒有任何東西，快來看看有什麼<a href="<?=base_url("Announcement")?>">新活動</a>！
            </div>
            <?php
            }else{
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
                    $isInfo = FALSE;
                    
                    foreach($cart as $book)
                    {
                        if($isInfo){
                            echo '<tr class="info"><td>';
                        }
                        else
                        {
                            echo "<tr><td>";
                        }
                        $isInfo = ! $isInfo;
                        echo $book->ISBN;							
    					echo "</td><td style='width: 30%;'>";
                        echo '<a href="' . base_url() . 'ViewBook/book/' . $book->bid . '">' . $book->name . "</a>";
    					echo "</td><td>";
                        echo $book->quantity; 
    					echo "</td><td>";
                        echo $book->price;
                        echo "</td><td>";
                        echo $book->discountName;
                        echo "</td><td>";
                        echo $book->soldPrice;
                        echo "</td><td>";
                        echo '<button type="button" class="btn btn-mini btn-danger" onclick="removeShoppingCart(this, '.$book->bid.')">取消訂購</button>';
                        echo "</td></tr>";
                    }
                    ?>
				</tbody>
			</table>
            <div>
            <?php
                echo '打折小計-> '.$after_discount_total_price;
                echo '<br/>    '.$rebateName;
                echo ' 再折-> '.$rebatePrice;
                echo '<br/>總計'.$totalPrice;
            }
            ?>
            </div>
		</div>
	</div>
</div>