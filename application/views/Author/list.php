
query row number = <?= $num_rows ?>      <br />
total row number = <?= $total_NumRows ?> <br /><br /><br /><br />

<?php foreach ($authors->result() as $author): ?>
    <?php print_r($author)?>
    <br />
<?php endforeach ?>
<br/>
browse author with id
<input type="text" id="browse_pid">
<input type="button" value="Browse" onclick="browse()">
<br />
<br />
<form action="#">
<table>
<tr>
<td>name</td>
<td><input id ="name" type="text"></td>
</tr>
<tr>
<td>introduction</td>
<td><input id ="introduction" type="text"></td>
</tr>
</table>
</form>
<input type="button" onclick="add()" value="Add">
<br />
enter ID and Use form above to update Author
<input type="text" id="id_for_update">
<input type="button" onclick="update()" value="Update">
<br />
deleteID<input type="text" id="deleteID">
<input type="button" onclick="deleteItem()" value="delete">
<script type="text/javascript">
function browse()
{
    window.location = '/TTS/Author/browse/'+$("#browse_pid").val();
}
function add()
{
    var arr = ['name','introduction'];
    var herf = '/TTS/Author/Create';
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
    var arr = ['id_for_update','name','introduction'];
    var herf = '/TTS/Author/Update';
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
    window.location = '/TTS/Author/Delete/'+$("#deleteID").val();
}
</script>