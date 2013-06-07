<?php echo validation_errors(); ?>
<?php echo form_open_multipart('ShoppingCart/getWholeShoppingCart') ?>

	mid <input type="text" name="mid" size="20"/>
    limit <input type="text" name="limit" size="20"/>
    offset <input type="text" name="offset" size="20"/>
	<input type="submit" name="submit" value="Get Information" /> 

</form>
