<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Member/modifyMemberPassword') ?>
    email <input type="text" name="email" size="20"/>
    password <input type="text" name="password" size="20"/>
    newPassword <input type="text" name="newPassword" size="20"/>
	<input type="submit" name="submit" value="Modify" /> 
</form>