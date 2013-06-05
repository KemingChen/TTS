<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1">
      <!--Sidebar space-->
    </div>
    <div class="span2">
        <div class="sidebar-nav">
    		<ul class="nav nav-pills nav-stacked"> 
    			<li class="active"><a href="#"><i class="icon-chevron-right"></i>商業理財</a></li>
                <li><a href="#"><b class="icon-chevron-right"></b>文學小說</a></li>
                <li><a href="#"><b class="icon-chevron-right"></b>藝術設計</a></li>
                <li><a href="#">...施工中</a></li>
            </ul>
        </div>
    </div>
    <div class="span7">
        <?$this->load->view($pageName, $data, false);?>
    </div>
  </div>