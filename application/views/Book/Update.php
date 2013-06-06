<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Book/editBookInformation') ?>

    <input type="file" name="cover" size="20"/>
	bid <input type="text" name="bid" size="20"/>
    name <input type="text" name="name" size="20"/>
    pid <input type="text" name="pid" size="20"/>
    publishedDate <input type="text" name="publishedDate" size="20"/>
    price <input type="text" name="price" size="20"/>
    ISBN <input type="text" name="isbn" size="20"/>
    onshelf <input type="text" name="onshelf" size="20"/>
	<input type="submit" name="submit" value="Update" /> 

</form>
