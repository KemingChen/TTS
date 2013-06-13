<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							書名
						</th>
						<th>
							賣出數量
						</th>
						<th>
                            獲利
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = FALSE;
                    foreach ($list as $report){
                        if($isSuccess){
    					   echo '<tr class="success">';
                        }else{
					       echo "<tr>";
                        }
                        $isSuccess = ! $isSuccess;
                ?>
						<td>
							<?=$report->name?>
						</td>
						<td>
							<?=$report->TOTAL_QUANTITY?>
						</td>
						<td>
                            <?=$report->profit ?>
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