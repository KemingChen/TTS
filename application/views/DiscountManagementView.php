<script>
function updateRebate(deid){
    console.log(deid);
    var name = $("#name" + deid).val()
    console.log("name=" + name);
    var cid = $("#cid" + deid).val();
    console.log("cid=" + cid);
    var startTime = $("#startTime" + deid).val()
    console.log("startTime=" + startTime);
    var endTime = $("#endTime" + deid).val()
    console.log("endTime=" + endTime);
    var discountRate = $("#discountRate" + deid).val()
    console.log("discountRate=" + discountRate);
    //update($deid, $cid, $name, $startTime, $endTime, $discountRate)
    var updateUrl = "<?= base_url("DiscountManagement/update") ?>/" 
        + deid + "/" + cid + "/" + fixedEncodeURIComponent(name) + "/" + startTime + "/" + endTime + "/" + discountRate;
    console.log((updateUrl));
    $.ajax({url: updateUrl}).done(function (data){
        console.log(data);
        if(data=="OK"){
            action = Array();
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

function insertDiscount(){
    var name = $("#name").val()
    console.log("name=" + name);
    var cid = $("#cid").val();
    console.log("cid=" + cid);
    var startTime = $("#startTime").val()
    console.log("startTime=" + startTime);
    var endTime = $("#endTime").val()
    console.log("endTime=" + endTime);
    var discountRate = $("#discountRate").val()
    console.log("discountRate=" + discountRate);
    //add($cid, $name, $startTime, $endTime, $discountRate)
    var addUrl = "<?= base_url("DiscountManagement/insertDiscount") ?>/" 
        + cid + "/" + fixedEncodeURIComponent(name) + "/" + startTime + "/" + endTime + "/" + discountRate;
    console.log((addUrl));
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
							折扣編號
						</th>
						<th>
							折扣名稱
						</th>
						<th>
							類別名稱
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
                $isSuccess = false;
                foreach ($list as $discount) {
                    if ($isSuccess) {
                        echo '<tr class="success">';
                    } else {
                        echo "<tr>";
                    }
                    $isSuccess = !$isSuccess;
                ?>
						<td>
							<?= $discount->deid ?>
						</td>
						<td>
                            <textarea rows="3" class="input-medium" id="name<?= $discount->deid ?>"><?= $discount->name ?></textarea>
						</td>
						<td>
                            <select id="cid<?= $discount->deid ?>">
                            <?php
                            foreach($categoryList as $category){
                            ?>
                                <option value="<?=$category->cid?>"
                                <?php
                                if($category->cid == $discount->cid){
                                    echo " selected='true'";
                                }
                                ?>
                                ><?=$category->name?></option>
                            <?php
                            }
                            ?>
                            </select>
						</td>
						<td>
                            <input type="date" class="input-medium" id="startTime<?= $discount->deid ?>" value="<?= $discount->startTime ?>"/>
						</td>
						<td>
                            <input type="date" class="input-medium" id="endTime<?= $discount->deid ?>" value="<?= $discount->endTime ?>"/>
						</td>
						<td>
                            <input type="number" class="input-small" id="discountRate<?= $discount->deid ?>" value="<?= $discount->discount_rate ?>"/>
						</td>
                        <td>
                            <button class="btn btn-info" onclick="updateRebate(<?= $discount->deid ?>)">修改</button>
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
                    新增折扣活動
                </h3>
            </div>
            <table>
				<thead>
					<tr>
						<th>
							折扣名稱
						</th>
						<th>
							類別名稱
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
                    <tr>
        				<td class="info">
                            <textarea rows="3" class="input-medium" id="name"></textarea>
        				</td>
        				<td>
                            <select id="cid">
                            <?php
                            foreach($categoryList as $category){
                            ?>
                                <option value="<?=$category->cid?>"><?=$category->name?></option>
                            <?php
                            }
                            ?>
                            </select>
        				</td>
        				<td>
                            <input type="date" class="input-medium" id="startTime" value="<?=date('Y-m-d'); ?>" />
        				</td>
        				<td>
                            <input type="date" class="input-medium" id="endTime" value="<?=date('Y-m-d'); ?>"/>
        				</td>
        				<td>
                            <input type="number" class="input-small" id="discountRate" value="1"/>
        				</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button class="btn btn-info" onclick="insertDiscount()">新增</button>
            </div>
        </div>
	</div>
</div>