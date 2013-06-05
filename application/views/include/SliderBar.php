<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1">
      <!--Sidebar space-->
    </div>
    <div class="span2">
        <div class="sidebar-nav">
    		<ul class="nav nav-pills nav-stacked"> 
            <?
                for($i=0;$i<count($menu);$i++)
                {
                    $active = $menu[$i]["Active"];
                    $tag = $menu[$i]["Tag"];
                    $id = $menu[$i]["ID"];
                    $url = base_url()."Nav/".$menu[$i]["Url"];
                    echo "<li class='$active'>";
                    echo "<a href='$url'>";
                    echo "<i class='icon-chevron-right'></i>$tag";
                    echo "</a>";
                    echo "</li>";
                }
            ?>
                <li><a href="#">...施工中</a></li>
            </ul>
        </div>
    </div>
    <div class="span7">
        <?$this->load->view($pageName, $data, false);?>
    </div>
  </div>