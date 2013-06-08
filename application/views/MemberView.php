<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>會員資料</h3>
            <style>
                .item{
                    width: 20%;
                }
            </style>
            <form action="javascript: alert('送出修改')" method="post">
    			<table class="table table-striped" id="memberinfo">
    				<tbody>
    					<tr>
    						<td class="item">電子郵件</td>
    						<td id="email"><?=$email?></td>
    					</tr>
    					<tr class="info">
    						<td class="item">名稱</td>
    						<td id="name"><?=$name?></td>
    						<td class="hide"><input type="text" /></td>
    					</tr>
    					<tr>
    						<td class="item">生日</td>
    						<td id="bitrhdate"><?=$birthDate?></td>
    						<td class="hide"><input type="text" /></td>
    					</tr>
    					<tr class="info">
    						<td class="item">郵遞區號</td>
    						<td id="$zipcode"><?=$zipCode?></td>
    						<td class="hide"><input type="text" /></td>
    					</tr>
    					<tr>
    						<td class="item">地址</td>
    						<td id="$address"><?=$address?></td>
    						<td class="hide"><input type="text" /></td>
    					</tr>
    				</tbody>
    			</table>
                <input type="button" id="canceleditinfo" class="btn btn-danger pull-right hide" onclick="cancelEditInfo()" value="取消" />
                <input type="submit" id="submitedit" class="btn btn-primary pull-right hide" value="確定" />
                <input type="button" id="editmemberinfo" class="btn pull-right btn-inverse" onclick="editMemberInfo()" value="修改資料" />
            </form>
            <script>
                function editMemberInfo()
                {
                    var inputs = $("#memberinfo").find("tr input");
                    for(var i=0; i<inputs.length; i++)
                    {
                        var input = $(inputs[i]);
                        var source = $(input.parent().parent().find("td")[1]);
                        input.attr("name", source.attr("id"));
                        input.val(source.html());
                        source.hide();
                        input.parent().show();
                    }
                    $("#editmemberinfo").hide();
                    $("#submitedit").show();
                    $("#canceleditinfo").show();
                }
                
                function cancelEditInfo()
                {
                    var inputs = $("#memberinfo").find("tr input");
                    for(var i=0; i<inputs.length; i++)
                    {
                        var input = $(inputs[i]);
                        var source = $(input.parent().parent().find("td")[1]);
                        source.show();
                        input.parent().hide();
                    }
                    $("#editmemberinfo").show();
                    $("#submitedit").hide();
                    $("#canceleditinfo").hide();
                }
            </script>
		</div>
	</div>
</div>