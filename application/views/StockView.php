<script>
    function stock(bid){
        
        quantity = $("#quantity" + bid).val();
        if(quantity==""){
            showReminderMsg("數量欄位請輸入數字");
        }else if(quantity<1){
            showReminderMsg("數量欄位至少進貨一本");
        }else{
            
            cost = $("#cost" + bid).val();
            if(cost==""){
                showReminderMsg("單價欄位請輸入數字");
            }else if(cost<0){
                showReminderMsg("單價欄位不能輸入負數");
            }else{
                cost = parseInt(cost, 10);
                quantity = parseInt(quantity, 10);
                console.log("quantity=" + quantity + ", cost=" + cost);
                
                $.ajax({url: "<?= base_url("Stock/addStockRecord") ?>/" + bid + "/" + cost + "/" + quantity}).
                    done(function(data){
                        showReminderMsg("成功進貨。");
                        $("#quantity" + data).parent().parent().remove();
                    }).
                    error(function(){
                        showReminderMsg("進貨失敗>___<");
                    });  
            }
        }
    }
    
    function addBookInfo()
    {
        var isbns = encodeURIComponent(($("#ISBNS").val().replace(" ", "")));
        $("#searchbox").attr("disabled", true);
        $.ajax({url: "<?= base_url("Stock/getBookInfo")?>/" + isbns})
        .done(function(datas){
            trs = datas.match(/<tr\b[^>]*>([\s\S]*?)<\/tr>/gm);
            scripts = datas.match(/<script\b[^>]*>([\s\S]*?)<\/script>/gm);
            $("#content").html(trs + $("#content").html());
            $("#Error").html(scripts);
            $("#searchbox").attr("disabled", false);
            console.log(datas);
        })
        .error(function(data){
            $("#searchbox").attr("disabled", false);
            console.log(data);
        })
    }
    
    function clearContent()
    {
        $("#content").html('');
    }
</script>
<style>
    .input{
        width: 50px;
    }
</style>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            <form class="navbar-form pull-left" onsubmit="addBookInfo();return false;">
                <input type="text" class="search-query" id="ISBNS" placeholder="請輸入ISBN" />
                <button type="submit" id="searchbox" class="btn btn-min">搜尋書籍</button>
                <button align="right" type="button" class="btn btn-min" onclick="clearContent()">清空列表</button>
			</form>
            <br /><br /><br />
            <div id="Error"></div>
            <table class="table table-bordered">
				<thead>
					<tr>
						<th>ISBN</th>
						<th>書名</th>
						<th>數量</th>
						<th>成本</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="content">
                    
				</tbody>
			</table>
		</div>
	</div>
</div>