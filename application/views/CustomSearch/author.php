<?php echo validation_errors(); ?>
<?php echo form_open_multipart('CustomSearch/searchByAuthor') ?>

	authorName <input type="text" name="authorName" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
