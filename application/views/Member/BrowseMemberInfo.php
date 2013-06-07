<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Member/browseMemberInfo') ?>
    email <input type="text" name="email" size="20"/>
	<input type="submit" name="submit" value="GetInfo" /> 
</form>
