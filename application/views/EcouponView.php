<style>
    .titleInfo{
        font-size: 18px;
        font-weight: bolder;
    }
</style>
<script>
    function sendEcoupon()
    {
        var totalnum = $("#totalnum").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var price = $("#price").val();
        
        if(totalnum == "" || endDate == "" || startDate == "" || price =="")
        {
            showReminderMsg("尚有未填項目!!!");
        }
        else if((new Date(startDate)) > (new Date(endDate)))
        {
            showReminderMsg("起始日期 和 截止日期 有問題!!!");
        }
        else
        {
            $("#sendEcoupon").attr("disabled", true);
            $("#sendEcoupon").val("發送中....");
            $.ajax({url: "<?= base_url("ViewEcoupon/sendEcoupon") ?>/"+totalnum+"/"+price+"/"+startDate+"/"+endDate})
            .done(function(data){
                $("#sendEcoupon").val("發送 Ecoupon");
                $("#sendEcoupon").attr("disabled", false);
                showReminderMsg("所有 ECoupon 已送出!!!");
            })
            .error(function(data){
                $("#sendEcoupon").val("發送 Ecoupon");
                $("#sendEcoupon").attr("disabled", false);
                showReminderMsg("寄送失敗>__<");
            });
        }
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>隨機發送 Ecoupon 給會員</h3>
            <table class="table">
                <tr>
                    <td colspan="2">
                        <label class="titleInfo">選擇要發給幾位會員</label>
                        <input type="text" id="totalnum" style="width: 80px;" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="titleInfo">起始日期</label>
                        <input type="date" id="startDate" />
                    </td>
                    <td>
                        <label class="titleInfo">截止日期</label>
                        <input type="date" id="endDate" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="titleInfo">金額</label>
                        <input type="text" id="price" style="width: 80px;" />
                    </td>
                </tr>
            </table>
            <input id="sendEcoupon" type="button" value="發送 Ecoupon" class="btn" onclick="sendEcoupon()" />
        </div>
	</div>
</div>