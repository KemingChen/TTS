<div>
<?php
    if(isset($message)){
        echo $message;
    }
?>
</div>

<?php echo validation_errors(); ?>
<?php echo form_open_multipart('AddBook') ?>
    <label>書名</label>
    <input type="text" name="name"/>
    
    <label>ISBN</label>
    <input type="text" name="ISBN"/>
    
    <label>圖片</label>
    <input type="file" name="cover" size="20"/>
    
	<label for="description">敘述</label>
	<textarea name="description"></textarea><br />
    
    <label>出版社</label>
	<select class="selectpicker" name="pid">
    <?php
    foreach ($publisherList as $publisher) {
    ?>
        <option value="<?= $publisher->pid ?>"><?= $publisher->name ?></option>
    <?php
    }
    ?>
    </select>
    
    <label>出版日期</label>
    <input type="date" name="publishedDate"/>

    <label>類別</label>
    <?php
    foreach ($categoryList as $category) {
    ?>
    <label class="checkbox">
        <input type='checkbox' name='category[]' value='<?= $category->cid ?>'/><?= $category->
    name ?>
    </label>
    <?php
    }
    ?>
    
    <label>單價</label>
    <input type="number" name="price"/>

	<input type="submit" name="submit" value="Create" /> 

</form>
