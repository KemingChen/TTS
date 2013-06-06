<?php echo validation_errors(); ?>
<?php echo form_open_multipart('ShoppingCart/addShoppingCart') ?>
    mid <input type="text" name="mid" size="20"/>
	bid <input type="text" name="bid" size="20"/>
    quantity <input type="text" name="quantity" size="20"/>
	<input type="submit" name="submit" value="Add" /> 

</form>
