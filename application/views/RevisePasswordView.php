<script>
    function repassword()
    {
        var passwd = $("#newpasswd").val(), oldpasswd = $("#newpasswd").val();
        if(passwd == "" || oldpasswd == "")
        {
            showReminderMsg("密碼不能為空");
            return false;
        }
        else if(passwd != $("#checkpasswd").val())
        {
            showReminderMsg("新密碼 兩次不相符");
            return false;
        }
        return true;
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<form action="javascript: alert('OK');" method="post" onsubmit="return repassword()">
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
                        <button type="submit" class="btn">確定修改</button>
                    </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>