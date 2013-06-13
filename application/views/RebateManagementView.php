<script>
function updateRebate(reid){
    console.log(reid);
    var name = $("#name" + reid).val()
    console.log("name=" + name);
    var startTime = $("#startTime" + reid).val()
    console.log("startTime=" + startTime);
    var endTime = $("#endTime" + reid).val()
    console.log("endTime=" + endTime);
    var threshold = $("#threshold" + reid).val()
    console.log("threshold=" + threshold);
    var price = $("#price" + reid).val()
    console.log("price=" + price);
    var updateUrl = "<?= base_url("RebateManagement/update") ?>/" 
        + reid + "/" + fixedEncodeURIComponent(name) + "/" + startTime + "/" + endTime + "/" + threshold + "/" + price;
    console.log((updateUrl));
    $.ajax({url: updateUrl}).done(function (data){
        console.log(data);
        if(data=="OK"){
            action = Array()
            action["name"]= "確定";
            action["click"] = function(){
                document.location.reload();
            };
            showReminderMsg("成功修改", action);
        }else{
            showReminderMsg("資料有誤，開始時間不能大於結束時間", action);
        }
    });
}

function fixedEncodeURIComponent (str) {
  return encodeURIComponent(str).replace(/[!'()]/g, escape).replace(/\*/g, "%2A");
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
                        <th></th>
					</tr>
				</thead>
				<tbody>
                
                <?php
$isSuccess = false;
foreach ($list as $rebate) {
    if ($isSuccess) {
        echo '<tr class="success">';
    } else {
        echo "<tr>";
    }
    $isSuccess = !$isSuccess;
?>
						<td>
							<?= $rebate->reid ?>
						</td>
						<td>
                            <textarea rows="3" class="input-medium" id="name<?= $rebate->
reid ?>"><?= $rebate->
name ?></textarea>
						</td>
						<td>
                            <input type="date" class="input-medium" id="startTime<?= $rebate->
reid ?>" value="<?= $rebate->
startTime ?>"/>
						</td>
						<td>
                            <input type="date" class="input-medium" id="endTime<?= $rebate->
reid ?>" value="<?= $rebate->
endTime ?>"/>
						</td>
						<td>
                            <input type="number" class="input-small" id="threshold<?= $rebate->
reid ?>" value="<?= $rebate->
threshold ?>"/>
						</td>
						<td>
                            <input type="number" class="input-small" id="price<?= $rebate->
reid ?>" value="<?= $rebate->
price ?>"/>
						</td>
                        <td>
                            <button class="btn btn-info" onclick="updateRebate(<?= $rebate->
reid ?>)">修改</button>
                        </td>
                <?php
}
?>
				</tbody>
			</table>
            <?= $pagination ?>
		</div>
	</div>
</div>