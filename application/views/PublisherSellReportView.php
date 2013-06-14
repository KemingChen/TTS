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
                        </div>
						</td>
				</tbody>
		</div>
	</div>
</div>





<!--
You are free to copy and use this sample in accordance with the terms of the
Apache license (http://www.apache.org/licenses/LICENSE-2.0.html)
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Google Visualization API Sample
    </title>
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
        var jsonData =$.ajax({
          url: "<?=base_url("Report/publisherSellReport")?>",
          dataType:"json",
          async: false
          }).responseText;
        data = new google.visualization.DataTable(jsonData);
      
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization')).
            draw(data, {title:"出版社營業額分析"});
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 800px; height: 600px;"></div>
  </body>
</html>