

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
			     關注書單
			</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							ISBN
						</th>
						<th>
                            書名
						</th>
						<th>
							金額
						</th>
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
    					echo "</td><td>";
                        echo $book["Name"]; 
    					echo "</td><td>";
                        echo $book["Price"];
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