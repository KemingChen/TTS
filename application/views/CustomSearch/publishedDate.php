<?php echo validation_errors(); ?>
<?php echo form_open_multipart('CustomSearch/searchByPublishedDate') ?>

	publishedDate <input type="text" name="publishedDate" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
