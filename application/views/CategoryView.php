<style>
    .book{
        width: 90%;
        margin: auto;
        color: black;
        font-weight: bolder;
    }
</style>
<ul class="breadcrumb">
    <li>書籍<span class="divider">/</span></li>
    <li><?=$category?></li>
</ul>
<table class="table table-striped">
        <?php
        $counter = 0;
        echo "<tr>";
        foreach($list as $book)
        {
            $counter++;
        ?>
            <td width="20%">
                <a href="<?=base_url("ViewBook/book/$book->bid/$cid/$offset")?>">
                    <div class="well well-small book" align="center">
                        <img style="width: 100%;" src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" />
                        <div><?=$book->name?></div>
                    </div>
                </a>
            </td>
            <?php
            if($counter%5==0){
                echo "</tr><tr>";
            }
        }
        for(;$counter%5!=0;$counter++){
            echo "<td></td>";
        }
        echo "</tr>"
        ?>
</table>
    <?=$pagination?>