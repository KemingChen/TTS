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
                                <a href="<?=base_url("ViewReport/yearSell")?>" class="btn btn-success">年度分析</a>
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
      google.load('visualization', '1', {packages: ['imagechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        //var data = google.visualization.arrayToDataTable([
//          ['Name', 'Height', 'Smokes'],
//          ['Tong Ning mu', 174, true],
//          ['Huang Ang fa', 523, false],
//          ['Teng nu', 86, true]
//        ]);
        
        var jsonData =$.ajax({
          url: "<?=base_url("Report/eCouponUtility")?>",
          dataType:"json",
          async: false
          }).responseText;
        data = new google.visualization.DataTable(jsonData);
      
        var options = {};
      
        // 'bhg' is a horizontal grouped bar chart in the Google Chart API.
        // The grouping is irrelevant here since there is only one numeric column.
        options.cht = 'bhg';
      
        // Add a data range.
        var min = 0;
        var max = 700;
        options.chds = min + ',' + max;
      
        // Now add data point labels at the end of each bar.
      
        // Add meters suffix to the labels.
        var meters = 'N** m';
      
        // Draw labels in pink.
        var color = 'ff3399';
      
        // Google Chart API needs to know which column to draw the labels on.
        // Here we have one labels column and one data column.
        // The Chart API doesn't see the label column.  From its point of view,
        // the data column is column 0.
        var index = 0;
      
        // -1 tells Google Chart API to draw a label on all bars.
        var allbars = -1;
      
        // 10 pixels font size for the labels.
        var fontSize = 10;
      
        // Priority is not so important here, but Google Chart API requires it.
        var priority = 0;
      
        options.chm = [meters, color, index, allbars, fontSize, priority].join(',');
      
        // Create and draw the visualization.
        new google.visualization.ImageChart(document.getElementById('visualization')).
          draw(data, options);
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 300px; height: 300px;"></div>
  </body>
</html>