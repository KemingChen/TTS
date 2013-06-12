<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
				書本庫存
			</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ISBN</th>
						<th>書名</th>
						<th>庫存數量</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $isInfo = false;
                    foreach ($restQuantityList as $book) {
                        if ($isInfo) {
                            echo '<tr class="info"><td>';
                        } else {
                            echo "<tr><td>";
                        }
                    ?>
                                <?= $book["ISBN"] ?></td>
                            <td><?= $book["name"] ?></td>
                            <td><?= $book["quantity"] ?></td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>