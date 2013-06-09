<script>
    function removeConcern(obj, bid)
    {
        console.log(obj);
        $.ajax({url: "<?=base_url("Concern/Remove")?>"+"/"+bid}).
            done(function(data){
                if(data != "OK")
                    alert(data);
            });
        $(obj).parent().parent().remove();
    }
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3>
			     關注書單
			</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ISBN</th>
						<th>書名</th>
						<th>金額</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $isInfo = FALSE;
                    
                    foreach($list as $book)
                    {
                        echo $isInfo ? '<tr class="info"><td>' : "<tr><td>";
                        $isInfo = ! $isInfo;
                        echo $book->ISBN;							
    					echo "</td><td style='width: 65%;'>";
                        echo '<a href="'.base_url('ViewBook/Book/'.$book->bid).'">'.$book->name."</a>";
    					echo "</td><td>";
                        echo $book->price;
                        echo "</td><td>";
                        echo '<button type="button" class="btn btn-mini btn-danger" onclick="removeConcern(this, '.$book->bid.')">移除</button>';
                        echo "</td></tr>";
                    }
                    ?>
				</tbody>
			</table>
			<div class="pagination" align="center">
                <ul>    
                <?php
                    $url = base_url("ViewMember/Me/Concern")."/";
                    $page-1 >= 1 ? PrintPageliTag("Prev", $url.($page-1)) : "";
                    for($i=1;$i<=$pages;$i++)
                    {
                        PrintPageliTag($i, $url.$i, $i==$page ? "active" : "");
                    }
                    $page+1 <= $pages ? PrintPageliTag("Next", $url.($page+1)) : "";
                    
                    
                    function PrintPageliTag($word, $url, $active = "")
                    {
                        echo "<li class='$active'><a href='$url'>$word</a></li>";
                    } 
                ?>
                </ul>
            </div>
		</div>
	</div>
</div>