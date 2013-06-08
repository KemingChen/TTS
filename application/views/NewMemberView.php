<style>
    .max{
        width: 100%;
        height: 100%;
    }
    
    .line{
        min-height: 30px;
        font-size: 18px;
    }
</style>
<div class="row-fluid">
<form><?php echo validation_errors(); ?>
<?php echo form_open_multipart('Account/createAccount') ?>
    email <input type="email" name="email" size="20"/>
	password <input type="password" name="password" size="20"/>
    authority <input type="text" name="authority" size="8"/>
    zipCode <input type="number" name="zipCode" size="1"/>
    birthday <input type="date" name="birthday" size="6"/>
    address <input type="text" name="address" size="20"/>
    available <input type="text" name="available" size="1"/>
    name <input type="text" name="name" size="10"/>
    phoneNumber <input type="text" name="phoneNumber" size="10"/>
	<input type="submit" name="submit" value="Create" /> 
</form>

</div>