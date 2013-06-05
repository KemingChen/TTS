<?php echo validation_errors(); ?>

<?php echo form_open_multipart('Announcement/create') ?>

    <input type="file" name="picture"/>
	<label for="description">Description</label>
    <!-- label for屬性 不知道要幹嘛-->
	<textarea name="description"></textarea><br />
	
	<input type="submit" name="submit" value="Create" /> 

</form>
