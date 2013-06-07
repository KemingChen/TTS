<?php echo validation_errors(); ?>
<?php echo form_open_multipart('CustomSearch/searchByBooksellers') ?>

	sellerName <input type="text" name="sellerName" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
