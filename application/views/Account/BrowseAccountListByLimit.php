<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Account/browseAccountListByLimit') ?>
    start <input type="text" name="start" size="3"/>
	length <input type="text" name="length" size="3"/>
	<input type="submit" name="submit" value="Search" /> 
</form>
