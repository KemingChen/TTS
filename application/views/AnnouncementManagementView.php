<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            
            <?php $addFormHeader = form_open_multipart('AnnouncementManagement/create'); ?>
            <?php echo validation_errors(); ?>
            <input class="btn btn-primary" type="button" value="Create" onclick="create_or_edit(this)"
                data-formHeader='<?=$addFormHeader?>'/>
            <?php if ($total_NumRows <= 0) {?>
            <div id="empty">目前沒有任何活動！</div>
            <?php } else { ?>
            <div id="notempty">
    			<table class="table">
    				<thead>
    					<tr>
    						<th>編號</th>
    						<th>說明</th>
                            <th></th>
    					</tr>
    				</thead>
    				<tbody>
                    
                    <?php
                        $isSuccess = FALSE;
                        foreach ($list as $item){
                            if($isSuccess){
    					       echo '<tr class="success">';
                            }else{
    					       echo "<tr>";
                            }
                            $isSuccess = ! $isSuccess;
                            $formHeader = form_open_multipart('AnnouncementManagement/update/'.$item->adid);
                    ?>
    						<td>
    							<span class="badge badge-info"><?=$item->adid?></span>
    						</td>
    						<td>
                                <span type="text" id="desciption-<?=$item->adid?>"><?=$item->description ?></span>
    						</td>
                            <td>
                                <input class="btn btn-info" type="button" value="ShowPicture" onclick="show(this)" 
                                    data-adid="<?=$item->adid?>"
                                    data-pic="<?=base64_encode($item->picture)?>"/>
    						
                                <input id="edit-<?=$item->adid?>" class="btn" type="button" value="Edit" onclick="create_or_edit(this)" 
                                     data-formHeader='<?=$formHeader?>'
                                     />
                                <input class="btn btn-info" type="button" value="Delete" onclick="deleteObj(this)" data-adid="<?=$item->adid?>"/>
                            </td>
                    <?php
                        }
                    ?>
                        <!-- Modal -->
                        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Modal header</h3>
                          </div>
                          <div class="modal-body" align="center">
                            <p>One fine body…</p>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">OK</button>
                          </div>
                        </div>
                        <!-- EditModal -->
                        <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>EDIT</h3>
                          </div>
                          <div class="modal-body" align="center">
                                <div id="formheader">
                                <input id="updatePic" type="file" name="picture" style="width: 220px;"/>
                                <br />
                                <textarea name="description" placeholder="Description"></textarea>
                                </from>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" onclick="onUpdateSubmit()" data-dismiss="modal" aria-hidden="true">Sumbit</button>
                          </div>
                        </div>
    				</tbody>
    			</table>
                <div class="pagination" align="center">
                    <ul>    
                    <?php
                        $url = base_url("AnnouncementManagement/page")."/";
                        $page-1 >= 1 ? PrintPageliTag("Prev", $url.($page-1)) : "";
                        for($i=1;$i<=$pages;$i++)
                        {
                            PrintPageliTag($i, $url.$i, $i==$page ? "active" : "");
                        }
                        $page+1 <= $pages ? PrintPageliTag("Next", $url.($page+1)) : "";
                    ?>
                    </ul>
                </div>
            </div>
            <?php }
                function PrintPageliTag($word, $url, $active = "")
                {
                    echo "<li class='$active'><a href='$url'>$word</a></li>";
                }  
            ?>
		</div>
	</div>
</div>
<script>
function show(obj)
{
    var adid = $(obj).data('adid');
    var pic = $(obj).data('pic');
    var picElement = '<img src="data:image/jpeg;base64,'+pic+'" alt="photo">';
    var title = $("#desciption-"+adid).html();
    $('#myModalLabel').html(title);
    $('#myModal .modal-body').html(picElement);
    $('#myModal').modal();
}
function create_or_edit(obj)
{
    var formheader = $(obj).data('formheader')+$('#formheader').html();
    var title = $(obj).val();
    $("#editModal h3").html(title);
    $('#formheader').html(formheader)
    $('#editModal').modal();
}
function onUpdateSubmit(obj)
{
    $("#editModal #formheader").children().submit();
}
function deleteObj(obj)
{
    var adid = $(obj).data('adid');
    $(obj).attr("disabled", true);
    $.ajax({url: "<?=base_url("AnnouncementManagement/delete")?>"+"/"+adid}).
        done(function(data){
            if(data == "1")
            {
                $(obj).parent().parent().remove();
            }
            else
            {
                alert(data);
            }
                
        });
}

</script>