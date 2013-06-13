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
            action["HideIknow"] = "true";
            action["click"] = function(){
                document.location.reload();
            };
            showReminderMsg("成功修改", action);
        }else{
            showReminderMsg("資料有誤，開始時間不能大於結束時間");
        }
    });
}

function fixedEncodeURIComponent (str) {
  return encodeURIComponent(str).replace(/[!'()]/g, escape).replace(/\*/g, "%2A");
}

function insertRebate(){
    var name = $("#name").val()
    console.log("name=" + name);
    var startTime = $("#startTime").val()
    console.log("startTime=" + startTime);
    var endTime = $("#endTime").val()
    console.log("endTime=" + endTime);
    var threshold = $("#threshold").val()
    console.log("threshold=" + threshold);
    var price = $("#price").val()
    console.log("price=" + price);
    //insertRebate($name, $startTime, $endTime, $threshold, $price){
    var addUrl = "<?= base_url("RebateManagement/insertRebate") ?>/" 
        + fixedEncodeURIComponent(name) + "/" + startTime + "/" + endTime + "/" + threshold + "/" + price;
    console.log(addUrl);
    $.ajax({url: addUrl}).done(function (data){
        console.log(data);
        if(data=="OK"){
            action = Array()
            action["name"]= "確定";
            action["HideIknow"] = "true";
            action["click"] = function(){
                document.location.reload();
            };
            showReminderMsg("成功新增", action);
        }else{
            showReminderMsg("資料有誤，開始時間不能大於結束時間");
        }
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
                            <?= $rebate->name ?>
    					</td>
    					<td>
                            <?= $rebate->startTime ?>
    					</td>
    					<td>
                            <?= $rebate->endTime ?>
    					</td>
    					<td>
                            <?= $rebate->threshold ?>
    					</td>
    					<td>
                            <?= $rebate->price ?>
    					</td>
                    </tr>
                <?php
                }
                ?>
				</tbody>
			</table>
            <?= $pagination ?>
		</div>
		<div class="span12">
            <div>
                <h3>
                    新增減價活動
                </h3>
            </div>
            <table>
				<thead>
					<tr>
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
                    <tr>
        				<td>
                            <textarea rows="3" class="input-medium" id="name"></textarea>
        				</td>
        				<td>
                            <input type="date" class="input-medium" id="startTime" value="<?=date('Y-m-d'); ?>" />
        				</td>
        				<td>
                            <input type="date" class="input-medium" id="endTime" value="<?=date('Y-m-d'); ?>"/>
        				</td>
        				<td>
                            <input type="number" class="input-small" id="threshold" value=""/>
        				</td>
        				<td>
                            <input type="number" class="input-small" id="price" value="1"/>
        				</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button class="btn btn-info" onclick="insertRebate()">新增</button>
            </div>
        </div>
	</div>
</div>