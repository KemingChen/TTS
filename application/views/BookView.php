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
<ul class="breadcrumb">
    <li>書籍<span class="divider">/</span></li>
    <li><a href="<?=base_url("Nav/Category/$category")?>"><?=$category?></a><span class="divider">/</span></li>
    <li><?=$book?></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <h3><?=$book?></h3>
    </div>
    <div class="span4">
        <img class="img-polaroid max" src="<?=base_url()?>/img/9789570410976.jpg" />
    </div>
    <div class="span6 offset1">
        <table class="table">
            <tr>
                <td>ISBN</td>
                <td><i class="icon-chevron-right"></i> <?=$ISBN?></td>
            </tr>
            <tr>
                <td>作者</td>
                <td><i class="icon-chevron-right"></i> <?=$author?></td>
            </tr>
            <tr>
                <td>語言</td>
                <td><i class="icon-chevron-right"></i> <?=$language?></td>
            </tr>
            <tr>
                <td>出版社</td>
                <td><i class="icon-chevron-right"></i> <?=$publisher?></td>
            </tr>
            <tr>
                <td>譯者</td>
                <td><i class="icon-chevron-right"></i> <?=$translator?></td>
            </tr>
            <tr>
                <td>日期</td>
                <td><i class="icon-chevron-right"></i> <?=$date?></td>
            </tr>
            <tr>
                <td>分類</td>
                <td>
                    <i class="icon-chevron-right"></i> 
                    <div class="label label-info"><?=$category?></div>
                    <div class="label label-info">生活</div>
                </td>
            </tr>
            <tr>
                <td>定價</td>
                <td><i class="icon-chevron-right"></i> <?=$price?></td>
            </tr>
        </table>
        <div class="btn-group">
            <button class="btn btn-middle btn-danger">加入購物車</button>
            <button class="btn btn-middle btn-warning">加入關注</button>
        </div>
    </div>
    <div class="span12"></div>
    <div class="span10">
        <h4 class="line">內容簡介</h4>
        <?=$description?>
    </div>
</div>