<?php echo validation_errors(); ?>
<?php echo form_open_multipart('CustomSearch/searchByCategory') ?>

	category <input type="text" name="category" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
