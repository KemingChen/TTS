<div class="container-fluid">
	<div class="row-fluid">
        <div class="span10 offset1">
            <div class="span12">
                <div id="myCarousel" class="carousel slide visible-desktop">
                    <ol class="carousel-indicators">
                    <?php
                        $count = 0;
                        foreach($list as $item)
                        {
                            $active = $count == 0 ? "active" : "";
                            echo "<li data-target='#myCarousel' data-slide-to='$count' class='$active'></li>";
                            $count++;
                        }
                    ?>
                    </ol>
                    <div class="carousel-inner">
                    <?php
                        $count = 0;
                        foreach($list as $item)
                        {
                            $active = $count == 0 ? "active" : "";
                        ?>
                            <div class="item <?=$active?>" style="height: 500px;background-color: #DDDDDD;" align="center">
                                <img style="height: 100%;" src="data:image/jpeg;base64,<?=base64_encode($item->picture)?>" alt="" />
            					<div class="carousel-caption">
                                    <h4><?=$item->description ?></h4>
                                </div>
                            </div>
                        <?
                            $count++;
                        }
                    ?>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                </div>
    		</div>
        </div>
            <div class="span10 offset1 hotRanking">
    			<h3>
    				近期新書
    			</h3>
    			<table class="table">
                    <tr>
                    <?php
                    foreach ($latestPublishList as $book)
                    {
                    ?>
                        <td width="20%">
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <img src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" alt="photo"/>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                    <tr>
                    <?php
                    foreach ($latestPublishList as $book)
                    {
                    ?>
                        <td>
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <?=$book->name?>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
    			</table>
            </div>
            
            <div class="span10 offset1 hotRanking">
    			<h3>
    				熱門暢銷書
    			</h3>
    			<table class="table">
                    <tr>
                    <?php
                    foreach ($hotRankingList as $book)
                    {
                    ?>
                        <td width="20%">
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <img src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" alt="photo"/>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                    <tr>
                    <?php
                    foreach ($hotRankingList as $book)
                    {
                    ?>
                        <td>
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <?=$book->name?>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
    			</table>
            </div>
            
            <div class="span10 offset1 hotRanking">
    			<h3>
    				最多人關注
    			</h3>
    			<table class="table">
                    <tr>
                    <?php
                    foreach ($mostConcernedList as $book)
                    {
                    ?>
                        <td width="20%">
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <img src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" alt="photo"/>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                    <tr>
                    <?php
                    foreach ($mostConcernedList as $book)
                    {
                    ?>
                        <td>
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <?=$book->name?>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
    			</table>
            </div>
            
            <div class="span10 offset1 hotRanking">
    			<h3>
    				<?=$categoryName?>類別暢銷書
    			</h3>
    			<table class="table">
                    <tr>
                    <?php
                    foreach ($categoryBookList as $book)
                    {
                    ?>
                        <td width="20%">
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <img src="data:image/jpeg;base64,<?=base64_encode($book->cover)?>" alt="photo"/>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                    <tr>
                    <?php
                    foreach ($latestPublishList as $book)
                    {
                    ?>
                        <td>
                            <a href="<?=base_url("ViewBook/book/$book->bid//0")?>">
                                <?=$book->name?>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
    			</table>
            </div>
	</div>
</div>