<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            <div>
            <?php echo validation_errors(); ?></div>
            <?php echo form_open_multipart('ForgotPassword') ?>
				<fieldset>
					 <legend>忘記密碼</legend>
            <?php
            if (isset($message)) {
            ?>
        		<div class="span12">
        			<h3>
                        <?= $message ?>
        			</h3>
        		</div>
            <?php
            }
            ?>
                      <label>Email</label>
                      <input type="email" name="email"/>
                      <button type="submit" name="submit" class="btn">Submit</button>
				</fieldset>
			</form>
		</div>
	</div>
</div>
