<?php echo validation_errors(); ?>
<?php echo form_open_multipart('CustomSearch/searchByName') ?>

	name <input type="text" name="name" size="20"/>
	<input type="submit" name="submit" value="Search" /> 

</form>
