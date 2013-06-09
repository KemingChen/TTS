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
        $limit = 4;
        $counter = 0;   
        foreach($list as $book)
        {
            echo $counter%$limit==0 ? "<tr>" : ""; 
            ?>
                <td style="width: <?=(100/$limit."%")?>;">
                    <a href="<?=base_url("ViewBook/book/$cid/$page/$book->bid")?>">
                        <div class="well well-small book" align="center">
                            <img style="width: 100%;" src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" />
                            <div><?=$book->name?></div>
                        </div>
                    </a>
                </td>
            <?php     
            echo $counter%$limit==($limit-1) ? "</tr>" : "";    
            $counter++;
        }
        for(;$counter%$limit!=0;$counter++)
        {
            echo "<td></td>";
            echo $counter%$limit==($limit-1) ? "</tr>" : "";   
        }
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