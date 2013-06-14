<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
				<thead>
					<tr>
						<th>
							觀看報表分析
						</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
                        <td>
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/bookSell")?>" class="btn btn-success">書籍營業額分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/publisherSell")?>" class="btn btn-success">出版社營業額分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/activityAnalize")?>" class="btn btn-success">打折活動效益分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/ecouponUtility")?>" class="btn btn-success">ECoupon分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/yearSell/2013")?>" class="btn btn-success">年度分析</a>
                            </div>
                        </div>
						</td>
                        <td>
                            年份：<input type="text" class="search-query" id="year" />
                            <div class="btn-group">
                                <a class="btn btn-success" onclick=onSubmit("<?=base_url("ViewReport/yearSell/")?>") >產生報表</a>
                            </div>
                        </div>
                        </td>
				</tbody>
		</div>
	</div>
</div>
<script>
    function onSubmit(var string)
    {
        //alert("hahaha");
        alert(string);
        
        var year = encodeURIComponent(($("#year").val().replace(" ", "")));
        window.locatoin = url + year;
    }
</script>
