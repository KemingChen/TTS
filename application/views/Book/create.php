<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Book/create') ?>

    <input type="file" name="cover" size="20"/><br />
    <input type="text" name="name" size="20"/>name<br />
    <input type="text" name="pid" size="20"/>pid<br />
    <input type="text" name="publishedDate" size="20"/>publishedDate<br />
    <input type="text" name="price" size="20"/>price<br />
    <input type="text" name="isbn" size="20"/>ISBN<br />
    <input type="text" name="onshelf" size="20"/>onshelf<br />
    <br /><br /><br />
	<input type="submit" name="submit" value="Create" /> 
    

</form>
