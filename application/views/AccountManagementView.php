<script>
function setAccountAvaliable(mid, avaliable){
        console.log(mid + "," + avaliable);
        if(avaliable==1){
            $.ajax({url: "<?= base_url("Account/unfreeze") ?>/"+mid}).
                done(function(data){
                    if(data != "OK")
                        //alert(data);
                        location.reload();
                });  
        }else{
            $.ajax({url: "<?= base_url("Account/freeze") ?>/"+mid}).
                done(function(data){
                    if(data != "OK")
                        //alert(data);
                        location.reload();
                });       
        }
}

function setAccountAuthority(mid, authority){
    console.log(mid + "," + authority);
    $.ajax({url: "<?= base_url("Account/modifyAuthority") ?>/"+mid +"/" + authority}).
            done(function(data){
                if(data != "OK")
                    //alert(data);
                    location.reload();
            });  
}
</script>

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
							Email
						</th>
						<th>
							權限
						</th>
						<th>
							可使用
						</th>
					</tr>
				</thead>
				<tbody>
                
                <?php
                $isSuccess = false;
                foreach ($list as $account) {
                    if ($isSuccess) {
                        echo '<tr class="success">';
                    } else {
                        echo "<tr>";
                    }
                    $isSuccess = !$isSuccess;
                ?>
						<td>
							<?= $account->mid ?>
						</td>
						<td>
							<?= $account->email ?>
						</td>
						<td>
                            <?php
                            if($account->authority=="administrator"){
                            ?>
                                <select onchange="setAccountAuthority(<?=$account->mid?>,this.options[this.selectedIndex].value)">
                                    <option value="customer" onclick="setAccountAuthority()">Customer</option>
                                    <option value="manager">Manager</option>
                                    <option value="administrator" selected="true">Administrator</option>
                                </select>
                            <?php
                            }else if($account->authority=="manager"){
                            ?>
                                <select onchange="setAccountAuthority(<?=$account->mid?>,this.options[this.selectedIndex].value)">
                                    <option value="customer">Customer</option>
                                    <option value="manager" selected="true">Manager</option>
                                    <option value="administrator">Administrator</option>
                                </select>
                            <?php
                            }else{
                            ?>
                                <select onchange="setAccountAuthority(<?=$account->mid?>,this.options[this.selectedIndex].value)">
                                    <option value="customer" selected="true">Customer</option>
                                    <option value="manager">Manager</option>
                                    <option value="administrator">Administrator</option>
                                </select>
                            <?php
                            }
                            ?>
						</td>
                        <?php
                        if ($account->available == 0) {
                            ?>
						<td>
                            <a href="#" onclick="setAccountAvaliable(<?= $account->
        mid ?>, 1)"><?= $account->available ?></a>
						</td>
                        <?php
                            } else {
                        ?>
						<td>
                            <a href="#" onclick="setAccountAvaliable(<?= $account->
        mid ?>, 0)"><?= $account->available ?></a>
						</td>
                        <?php
    }
?>
                <?php
}
?>
				</tbody>
			</table>
            <?= $pagination ?>
		</div>
	</div>
</div>