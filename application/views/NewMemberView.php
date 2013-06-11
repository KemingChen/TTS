<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            <div>
            <?php
if (isset($error)) {
?>
        		<div class="span12">
        			<h3>
                        <?= $error ?>
        			</h3>
        		</div>
            <?php
}
?>
            <?php echo validation_errors(); ?></div>
            <?php echo form_open_multipart('NewMember') ?>
				<fieldset>
					 <legend>加入會員</legend>
                      <label>Email</label>
                      <input type="email" name="email"/>
                      <label>密碼</label>
                      <input type="password" name="password"/>
                      <label>郵遞區號</label>
                      <input type="number" name="zipCode"/>
                      <label>地址</label>
                      <input type="text" name="address"/>
                      <label>生日</label>
                      <input type="date" name="birthday"/>
                      <label>名稱</label>
                      <input type="text" name="name"/>
                      <label>電話</label>
                      <input type="text" name="phoneNumber"/>
                      <button type="submit" name="submit" class="btn">Submit</button>
				</fieldset>
			</form>
		</div>
	</div>
</div>