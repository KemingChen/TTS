<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							折扣編號
						</th>
						<th>
							折扣類別
						</th>
						<th>
							折扣名稱
						</th>
						<th>
							開始時間
						</th>
						<th>
							結束時間
						</th>
						<th>
							打折比率
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = FALSE;
                    foreach ($list as $discount){
                        if($isSuccess){
					       echo '<tr class="success">';
                        }else{
					       echo "<tr>";
                        }
                        $isSuccess = ! $isSuccess;
                ?>
						<td>
							<?=$discount->deid?>
						</td>
						<td>
							<?=$discount->categoryName?>
						</td>
						<td>
							<?=$discount->name?>
						</td>
						<td>
							<?=$discount->startTime?>
						</td>
						<td>
							<?=$discount->endTime?>
						</td>
						<td>
							<?=$discount->discount_rate?>
						</td>
                <?php
                    }
                ?>
				</tbody>
			</table>
            <?=$pagination?>
		</div>
	</div>
</div>