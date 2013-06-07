<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				交易紀錄
			</h3>
			<table class="table">
				<thead>
					<tr>
						<th>
							交易編號
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
                        <th>
                            
                        </th>
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
                        echo '<a href="'. "#". '">觀看</a>';
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