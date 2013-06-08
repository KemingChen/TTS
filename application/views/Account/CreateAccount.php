<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Account/createAccount') ?>
    email <input type="text" name="email" size="20"/>
	password <input type="text" name="password" size="20"/>
    authority <input type="text" name="authority" size="8"/>
    zipCode <input type="text" name="zipCode" size="1"/>
    birthday <input type="text" name="birthday" size="6"/>
    address <input type="text" name="address" size="20"/>
    available <input type="text" name="available" size="1"/>
    name <input type="text" name="name" size="10"/>
    phoneNumber <input type="text" name="phoneNumber" size="10"/>
	<input type="submit" name="submit" value="Create" /> 
</form>
