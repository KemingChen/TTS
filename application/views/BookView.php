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
            done(function(data){
                if(data != "OK")
                    alert(data);
                else
                    showReminderMsg("已加入");
            });
    }
</script>
<ul class="breadcrumb">
    <li>書籍<span class="divider">/</span></li>
    <li><a href="<?=base_url("View/Category/$cid/$page")?>"><?=$cname?></a><span class="divider">/</span></li>
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
        </table>
        <div class="btn-group">
            <button class="btn btn-middle btn-danger">加入購物車</button>
            <button class="btn btn-middle btn-warning" onclick="addConcern(this, <?=$book->bid?>)">加入關注</button>
        </div>
    </div>
    <div class="span12"></div>
    <div class="span10">
        <h4 class="line">內容簡介</h4>
        <?=$book->description?>
    </div>
</div>