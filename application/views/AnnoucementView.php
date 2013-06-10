<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
            
            <div id="myCarousel" class="carousel slide">
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
                        <div class="item <?=$active?>" style="height: 500px;background-color: black;" align="center">
                            <img style="height: 100%;" src="data:image/jpeg;base64,<?=base64_encode($item->picture)?>" alt="" />
        					<div class="carousel-caption" style="background-color: gray;">
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
</div>