<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
  function drawVisualization() {
    // Create and populate the data table.
    //var data = google.visualization.arrayToDataTable([
//          ['Task', 'Hours per Day'],
//          ['Work', 11],
//          ['Eat', 2],
//          ['Commute', 2],
//          ['Watch TV', 2],
//          ['Sleep', 7]
//        ]);   
    var isbn = encodeURIComponent(($("#isbn").val().replace(" ", "")));
    var jsonData =$.ajax({
      url: "<?=base_url("Report/linear")?>" + '/' + isbn,
      dataType:"json",
      async: false
      }).responseText;
    data = new google.visualization.DataTable(jsonData);
  
    // Create and draw the visualization.
    new google.visualization.PieChart(document.getElementById('visualization')).
        draw(data, {title:"本書獲利"});
  }
  google.setOnLoadCallback(drawVisualization);
</script>
<div class="container-fluid">
    <div class="row-fluid">
    	<div class="span12">
            <table>
    			<thead>
    				<tr>
    					<th>
    						<h3>觀看報表分析</h3>
    					</th>
                        <th></th>
    				</tr>
    			</thead>
    			<tbody>
                    <tr></tr>
                        <td>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                <a href="<?=base_url("ViewReport/activityAnalize")?>" class="btn btn-success">打折活動效益分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/rebateSell")?>" class="btn btn-success">減價活動分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/ecouponUtility")?>" class="btn btn-success">ECoupon分析</a>
                            </div>
                            <br />
                            <br />
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/bookSell")?>" class="btn btn-success">書籍營業額分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/publisherSell")?>" class="btn btn-success">出版社營業額分析</a>
                            </div>
                            <br />
                            <br />
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/yearSell")?>" class="btn btn-success">年度分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/daySell")?>" class="btn btn-success">月份分析</a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/dallyBookSell")?>" class="btn btn-success">日營業分析</a>
                            </div>
                            <br />
                            <br />
                            <div class="btn-group">
                                <a href="<?=base_url("ViewReport/linearAnalize")?>" class="btn btn-success">線性規劃</a>
                            </div>
                            </div>
    					</td>
                    <tr>
                        <td>
                            ISBN：<input type="text" class="search-query" id="isbn" />
                            <div class="btn-group">
                                <a class="btn btn-success" onclick=drawVisualization() >產生報表</a>
                            </div>
                        </td>
                    </tr>              
    			</tbody>
        </table>
	</div>
</div>
</div>


<div id="visualization" style="width: 800px; height: 600px;"></div>
