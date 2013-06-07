<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Stock/addStockRecord') ?>
    bid <input type="text" name="bid" size="20"/>
	price <input type="text" name="price" size="20"/>
    amount <input type="text" name="amount" size="20"/>
    restAmount <input type="text" name="restAmount" size="20"/>
    stockTime <input type="text" name="stockTime" size="20"/>
	<input type="submit" name="submit" value="Add" /> 

</form>
