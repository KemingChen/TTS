<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Member/modifyMemberInfo') ?>
    email <input type="text" name="email" size="20"/>
    zipCode <input type="text" name="zipCode" size="1"/>
    birthday <input type="text" name="birthday" size="6"/>
    address <input type="text" name="address" size="20"/>
    name <input type="text" name="name" size="10"/>
	<input type="submit" name="submit" value="Modify" /> 
</form>
