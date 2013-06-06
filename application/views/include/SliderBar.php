<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1">
      <!--Sidebar space-->
    </div>
    <div class="span2">
        <div class="sidebar-nav">
    		<ul class="nav nav-pills nav-stacked"> 
                <?
                    foreach($menu as $item)
                    {
                        $active = $item["Active"];
                        $tag = $item["Tag"];
                        $url = $item["Url"];
                        echo "<li class='$active'>";
                        echo "<a href='$url'>";
                        echo "<i class='icon-chevron-right'></i>$tag";
                        echo "</a>";
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="span7" style="min-height: 500px;">
        <?$this->load->view($pageName, $data, false);?>
    </div>
  </div>