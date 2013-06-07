
query row number = <?= $num_rows ?>      <br />
total row number = <?= $total_NumRows ?> <br /><br /><br /><br />

<?php foreach ($publishers->result() as $publisher): ?>
    <?php print_r($publisher)?>
    <br />
<?php endforeach ?>

<br />
<br />
<!--mid =1 ,bid =2-->
<form action="#">
<table>
<tr>
<td>name</td>
<td><input id ="name" type="text"></td>
</tr>
<tr>
<td>address</td>
<td><input id ="address" type="text"></td>
</tr>
<tr>
<td>phone</td>
<td><input id ="phone" type="text"></td>
</tr>
<tr>
<td>webSite</td>
<td><input id ="webSite" type="text"></td>
</tr>
</table>
</form>
<input type="button" onclick="add()" value="Add">
<br />
enter pID and Use form above to update Publisher
<input type="text" id="pid_for_update">
<input type="button" onclick="update()" value="Update">
<br />
deleteID<input type="text" id="deleteID">
<input type="button" onclick="deleteItem()" value="delete">
<script type="text/javascript">
function add()
{
    var arr = ['name','address','phone','webSite'];
    var herf = '/TTS/Publisher/Create';
    for(i=0;i<arr.length;i++)
    {
        var val = $("#"+arr[i]).val();
        if(val==null)val='';
        herf += '/'+val;
    }
    window.location = herf;
}
function update()
{
    var arr = ['pid_for_update','name','address','phone','webSite'];
    var herf = '/TTS/Publisher/Update';
    for(i=0;i<arr.length;i++)
    {
        var val = $("#"+arr[i]).val();
        if(val==null)val='';
        herf += '/'+val;
    }
    window.location = herf;
}
function deleteItem()
{
    window.location = '/TTS/Publisher/Delete/'+$("#deleteID").val();
}
</script>