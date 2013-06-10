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
                        <th></th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                    $isSuccess = FALSE;
                    foreach ($list as $book){
                        if($isSuccess){
					       echo '<tr class="success">';
                        }else{
					       echo "<tr>";
                        }
                        $isSuccess = ! $isSuccess;
                ?>
						<td>
							<?=$book->bid?>
						</td>
						<td>
							<?=$book->ISBN?>
						</td>
						<td>
                            <?=$book->name ?>
						</td>
						<td>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="<?=base_url("OnShelf/on/$book->bid")?>" class="btn btn-success">On Shelf</a>
                                </div>
                            </div>
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