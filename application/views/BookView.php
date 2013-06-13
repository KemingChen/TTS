<style>
    .max{
        width: 100%;
        height: 100%;
    }
    
    .line{
        min-height: 30px;
        font-size: 18px;
    }
</style>
<script>
    function addConcern(obj, bid)
    {
        console.log(obj);
        $.ajax({url: "<?=base_url("Concern/Add")?>"+"/"+bid}).
            always(function(data){
                console.log(data);
                showReminderMsg("已加入關注列表");
            });
    }
    function addShopCar(obj, bid)
    {
        textValue = $("#quantity").val();
        console.log(textValue);
        if(textValue==""){
            showReminderMsg("請輸入數字");
        }else if(textValue<1){
            showReminderMsg("至少購買一本");
        }else{
            quantity = parseInt(textValue, 10);
            $.ajax({url: "<?=base_url("ShoppingCart/addBook")?>" + "/" + bid + "/" + quantity}).
                always(function(data){
                    action = Array()
                    action["name"]= "移至購物車";
                    action["click"] = function(){location.href = "<?=base_url("ViewMember/Me/ShopCar")?>";};
                    showReminderMsg("已加入", action);
                });
        }
    }
</script>
<ul class="breadcrumb">
    <li>書籍<span class="divider">/</span></li>
    <li><a href="<?=base_url("View/Category/$cid/$offset")?>"><?=$cname?></a><span class="divider">/</span></li>
    <li><?=$book->name?></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <h3><?=$book->name?></h3>
    </div>
    <div class="span4">
        <img style="width: 100%;height: 100%;" src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" />
    </div>
    <div class="span6 offset1">
        <table class="table">
            <tr>
                <td>ISBN</td>
                <td><i class="icon-chevron-right"></i> <?=$book->ISBN?></td>
            </tr>
            <tr>
                <td>作者</td>
                <td>
                <i class="icon-chevron-right"></i> 
                <?php
                foreach($writer as $item){
                ?>
                    <div class="label label-info"><?=$item->name?></div>
                <?php
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>出版社</td>
                <td><i class="icon-chevron-right"></i> <?=$book->pname?></td>
            </tr>
            <tr>
                <td>譯者</td>
                <td>
                    <i class="icon-chevron-right"></i> 
                    <?php
                    foreach($translator as $item){
                    ?>
                        <div class="label label-info"><?=$item->name?></div>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>日期</td>
                <td><i class="icon-chevron-right"></i> <?=$book->publishedDate?></td>
            </tr>
            <tr>
                <td>分類</td>
                <td>
                    <i class="icon-chevron-right"></i> 
                    <?php
                    foreach($category as $item){
                    ?>
                    <div class="label label-info"><?=$item->name?></div>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>定價</td>
                <td><i class="icon-chevron-right"></i> <?=$book->price?></td>
            </tr>
            <tr>
            <?php
            if(sizeof($discounts)>0){
                echo '<td>優惠</td><td><i class="icon-chevron-right"></i>';
                foreach($discounts as $discount)
                {
                    echo '<div class="label label-info">'.$discount->name.'</div>';
                }
                echo '</td>';
            }?>
            </tr>
        </table>
        <?php
        if($isLogin){
        ?>
        <div>
            <label>購買數量:</label>
            <input id="quantity" type="number" min="1" value="1" style="width: 80px;" />
        </div>
        <div class="btn-group">
            <button class="btn btn-middle btn-danger" onclick="addShopCar(this, <?=$book->bid?>)">加入購物車</button>
            <button class="btn btn-middle btn-warning" onclick="addConcern(this, <?=$book->bid?>)">加入關注</button>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="span12"></div>
    <div class="span10">
        <h4 class="line">內容簡介</h4>
        <?=$book->description?>
    </div>
</div>