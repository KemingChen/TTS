<?
foreach($lists as $list)
{
    foreach($list as $book)
    {
        ?>
        <tr>
        <td><?= $book->ISBN ?></td>
        <td style="width: 65%;"><?= $book->name ?></td>
        <td><input class="input" type="number" id="quantity<?=$book->bid?>"/></td>
        <td><input class="input" type="number" id="cost<?=$book->bid?>"/></td>
        <td style="width: 10%;"><button type="button" class="btn btn-small btn-info" onclick="stock(<?=$book->bid?>);">進貨</button></td>
        </tr>
        <?
    }
}
$first = true;
$temp = "";
foreach($errors as $error)
{
    $temp .= $first ? $error : ", ".$error;
    $first = false;
}
if($temp != "")
{
    ?>
    <script>
        showReminderMsg("ISBN: <?=$temp?> 找不到!!!");
    </script>
    <?
}
?>