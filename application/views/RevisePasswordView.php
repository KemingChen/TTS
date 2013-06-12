<script>
    function repassword()
    {
        var oldpasswd = $("#oldpasswd").val();
        var passwd = $("#newpasswd").val();
        var checkpasswd = $("#checkpasswd").val();
        if(passwd == "" || oldpasswd == "" || checkpasswd=="")
        {
            showReminderMsg("密碼不能為空");
            return false;
        }
        else if(passwd != checkpasswd)
        {
            showReminderMsg("密碼不相符");
            return false;
        }else{
        console.log("else");
        console.log("<?= base_url("ViewMember/revisePassword") ?>/" + oldpasswd + "/" + passwd);
            $.ajax({url: "<?= base_url("ViewMember/revisePassword") ?>/" + oldpasswd + "/" + passwd}).
                always(function(data){
                    if(data=="OK"){
                        console.log(data);
                        showReminderMsg("成功修改!");
                        setTimeout(function(){
                            document.location.reload();
                        }, 1000);
                    }else{
                        console.log(data);
                        showReminderMsg("密碼錯誤");
                        setTimeout(function(){
                            document.location.reload();
                        }, 1000);
                    }
                });
        }
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            <?php
if (isset($message)) {
?>
                <div class="success"><?= $message ?>
                </div>
                    <?php
}
?>
				<fieldset>
					<legend>修改密碼</legend>
                    <div>
                        <label>請輸入原密碼</label>
                        <input id="oldpasswd" name="oldpasswd" type="password" placeholder="Old Password" /> 
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
                        <button class="btn" onclick="repassword()">確定修改</button>
                    </div>
				</fieldset>
		</div>
	</div>
</div>