<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Announcement/update/'.$adid) ?>

    <input type="file" name="picture" size="20"/>
	<label for="description">Description</label>
    <!-- label for屬性 不知道要幹嘛-->
	<textarea name="description"></textarea><br />
	
	<input type="submit" name="submit" value="Update" /> 

</form>