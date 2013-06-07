<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Book/searchByCategory') ?>

	category <input type="text" name="category" size="20"/>
    limit <input type="text" name="limit" size="20"/>
    offset <input type="text" name="offset" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
