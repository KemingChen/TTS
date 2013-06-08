<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				購物車
			</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ISBN</th>
						<th>書名</th>
						<th>數量</th>
						<th>金額</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $isInfo = FALSE;
                    
                    foreach($list as $book)
                    {
                        if($isInfo){
                            echo '<tr class="info"><td>';
                        }
                        else
                        {
                            echo "<tr><td>";
                        }
                        $isInfo = ! $isInfo;
                        echo $book["ISBN"];							
    					echo "</td><td style='width: 50%;'>";
                        echo '<a href="' . base_url() . 'Nav/Book/' . $book["Name"]  . '">' . $book["Name"] . "</a>";
    					echo "</td><td>";
                        echo $book["Quantity"]; 
    					echo "</td><td>";
                        echo $book["Price"];
                        echo "</td><td>";
                        echo '<button type="button" class="btn btn-mini btn-danger">取消訂購</button>';
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