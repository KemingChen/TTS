<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							減價編號
						</th>
						<th>
							減價名稱
						</th>
						<th>
							開始時間
						</th>
						<th>
							結束時間
						</th>
						<th>
							底價
						</th>
						<th>
							回饋金額
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = FALSE;
                    foreach ($list as $rebate){
                        if($isSuccess){
					       echo '<tr class="success">';
                        }else{
					       echo "<tr>";
                        }
                        $isSuccess = ! $isSuccess;
                ?>
						<td>
							<?=$rebate->reid?>
						</td>
						<td>
							<?=$rebate->name?>
						</td>
						<td>
							<?=$rebate->startTime?>
						</td>
						<td>
							<?=$rebate->endTime?>
						</td>
						<td>
							<?=$rebate->threshold?>
						</td>
						<td>
							<?=$rebate->price?>
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