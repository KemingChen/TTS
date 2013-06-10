<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							編號
						</th>
						<th>
							圖片
						</th>
						<th>
							說明
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = FALSE;
                    foreach ($list as $item){
                        if($isSuccess){
					       echo '<tr class="success">';
                        }else{
					       echo "<tr>";
                        }
                        $isSuccess = ! $isSuccess;
                ?>
						<td>
							<?=$item->adid?>
						</td>
						<td>
							<img src="data:image/jpeg;base64,<?=base64_encode($item->picture)?>" alt="photo">
						</td>
						<td>
						  <?=$item->description ?>
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