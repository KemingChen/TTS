<?php echo validation_errors(); ?>
<?php echo form_open_multipart('ShoppingCart/removeShoppingCart') ?>
    mid <input type="text" name="mid" size="20"/>
	bid <input type="text" name="bid" size="20"/>
	<input type="submit" name="submit" value="Remove" /> 

</form>
