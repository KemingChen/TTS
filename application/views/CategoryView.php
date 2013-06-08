<style>
    .book{
        width: 100px;
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
        if(count($list)==0){
            echo "<td></td><td></td><td></td><td></td>";
        }
        foreach($list as $book){
            $counter++;
                ?>
                <td>
                    <a href="<?=base_url("ViewBook/book/$cid/$book->bid")?>">
                        <div class="well well-small book" align="center">
                            <img style="width: 100%;height: 100%;" src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" />
                            <div><?=$book->name?></div>
                        </div>
                    </a>
                </td>
                <?php
            if($counter%4==0){
                echo "</tr>";
            }
        }
        for(;$counter%4!=0;$counter++){
            echo "<td></td>";
        }
        echo "</tr>";
    ?>
</table>
<div class="pagination" align="center">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div>