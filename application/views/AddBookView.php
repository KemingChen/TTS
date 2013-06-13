<style>
    .titleInfo{
        font-size: 18px;
        font-weight: bolder;
    }
</style>
<?php

if(isset($error)){
    if($error=="false"){
        $msg ="書籍上傳成功^__^";
    }else if($error=="true"){
        $msg ="新增失敗>___<";
    }else{
        $msg="";
    }
}else {
    $msg="";
}
?>
<script>
    var errorMsg = "<?=$msg?>";
    if(errorMsg!="")
    {
        alert(errorMsg);
        /*console.log("<?=validation_errors()?>");*/
    }
</script>
<script>
    var selectedWriters = Array();
    var selectedTranslator = Array();
    function addWriter()
    {
        var selected = $("#writer").find(":selected");
        var tag = "Writer";
        var name = selected.text();
        var val = selected.val();
        if(!arrayContainVal(selectedWriters, val))
        {
            selectedWriters.push(val);
            $("#writers").append(createLabel(name, tag, val));
        }
        else
        {
            showReminderMsg(name+" 已經加入過了");
        }
    }
    
    function addTranslator()
    {
        var selected = $("#translator").find(":selected");
        var tag = "Translator";
        var name = selected.text();
        var val = selected.val();
        if(!arrayContainVal(selectedTranslator, val))
        {
            selectedTranslator.push(val);
            $("#translators").append(createLabel(name, tag, val));
        }
        else
        {
            showReminderMsg(name+" 已經加入過了");
        }
    }
    
    function deleteWriter(obj, val)
    {
        deleteArrayVal(selectedWriters, val);
        $(obj).parent().remove();
    }
    
    function deleteTranslator(val)
    {
        deleteArrayVal(selectedTranslator, val);
        $(obj).parent().remove();
    }
    
    function createLabel(name, tag, val)
    {
        return "<label class='label label-important' style='font-size: larger;margin-right: 3px;'>"+name+" | <i class='icon-remove icon-black' style='color: black;' onclick='delete"+tag+"(this, "+val+")'></i></label>"
    }
    
    function arrayContainVal(array, val)
    {
        for(var key in array)
        {
            if(array[key] == val)
            {
                return true;
            }
        }
        return false;
    }
    
    function deleteArrayVal(array, val)
    {
        for(var key in array)
        {
            if(array[key] == val)
            {
                delete(array[key]);
            }
        }
    }
    
    function beforeClick()
    {
        for(var key in selectedWriters)
        {
            $("#inputs").append(createInput("writer", selectedWriters[key]));
        }
        
        for(var key in selectedTranslator)
        {
            $("#inputs").append(createInput("translator", selectedTranslator[key]))
        }
        console.log(selectedWriters);
        console.log(selectedTranslator);
    }
    
    function createInput(name, val)
    {
        return "<input type='hidden' name='"+name+"[]' value='"+val+"'/>";
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>新增書籍</h3>
            <div class="alert <?=($error=="true" ? "" : "hide");?>">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <?=validation_errors()?>
            </div>
            <?=form_open_multipart('AddBook/index/Upload')?>
                <table class="table">
                    <tr class="info">
                        <td colspan="2">
                            <label class="titleInfo">圖片</label>
                            <input type="file" name="cover" size="20"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="titleInfo">書名</label>
                            <input type="text" name="name" />
                        </td>
                        <td>
                            <label class="titleInfo">ISBN</label>
                            <input type="text" name="ISBN"/>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>
                            <label class="titleInfo">出版社</label>
                        	<select class="selectpicker" name="pid">
                                <?php
                                    foreach ($publisherList as $publisher) {
                                    ?>
                                    <option value="<?= $publisher->pid ?>"><?= $publisher->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <label class="titleInfo">出版日期</label>
                            <input type="date" name="publishedDate"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <label class="titleInfo">作者</label>
                        	<select class="selectpicker" id="writer">
                                <?php
                                    foreach ($writerList as $writer) {
                                    ?>
                                    <option value="<?= $writer->aid ?>"><?= $writer->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button class="btn btn-small" type="button" onclick="addWriter()">+</button>
                            <div id="writers"></div>
                        </td>
                        <td width="50%">
                            <label class="titleInfo">譯者</label>
                            <select class="selectpicker" id="translator">
                                <?php
                                    foreach ($translatorList as $translator) {
                                    ?>
                                    <option value="<?= $translator->aid ?>"><?= $translator->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button class="btn btn-small" type="button" onclick="addTranslator()">+</button>
                            <div id="translators"></div>
                        </td>
                    </tr>
                    <tr class="info">
                        <td colspan="2">
                            <label class="titleInfo">敘述</label>
                            <textarea name="description" style="width: 100%;" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="titleInfo">類別</label>
                            <?php
                                foreach ($categoryList as $category) {
                                    ?>
                                    <label class="checkbox span2">
                                        <input type='checkbox' name='category[]' value='<?= $category->cid ?>'/><?= $category->name ?>
                                    </label>
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr class="info">
                        <td colspan="2">
                            <label class="titleInfo">單價</label>
                            <input type="number" name="price"/>
                        </td>
                    </tr>
                </table>
                <input id="sendEcoupon" type="submit" value="新增書品" class="btn" onclick="beforeClick();" />
                <div id="inputs" style="display: none;"></div>
            </form>
        </div>
	</div>
</div>