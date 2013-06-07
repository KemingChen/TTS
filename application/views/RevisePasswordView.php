<script>
    $("#repassword").click(function(){
        alert("我不能動");
    });
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<form>
				<fieldset>
					<legend>修改密碼</legend>
                    <div>
                        <label>請輸入原密碼</label>
                        <input name="oldpasswd" type="password" placeholder="Old Password" /> 
                    </div>
                    <div>
                        <label>請輸入新密碼</label>
                        <input id="newpasswd" name="newpasswd" type="password" placeholder="New Password" /> 
                    </div>
                    <div>
                        <label>再次確認</label>
                        <input id="checkpasswd" type="password" placeholder="New Password" /> 
                    </div>
                    <div>
                        <button id="repassword" type="submit" class="btn">確定修改</button>
                    </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>