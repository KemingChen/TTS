<style>
    .titleInfo{
        font-size: 18px;
        font-weight: bolder;
    }
</style>
<?=validation_errors()?>
<? if(isset($error))
{
    $msg = $error == "true" ? validation_errors() : "書籍上傳成功^__^";
    ?>
    <script>
    </script>
    <?
}
?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>新增書籍</h3>
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
                        <td colspan="2">
                            <label class="titleInfo">敘述</label>
                            <textarea name="description" style="width: 100%;" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr class="info">
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
                    <tr>
                        <td colspan="2">
                            <label class="titleInfo">單價</label>
                            <input type="number" name="price"/>
                        </td>
                    </tr>
                </table>
                <input id="sendEcoupon" type="submit" value="新增書品" class="btn" onclick="sendEcoupon()" />
            </form>
        </div>
	</div>
</div>