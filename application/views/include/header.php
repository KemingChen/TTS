<!DOCTYPE html>
<html lang="en">
<head>
    <title>台客書店</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Le styles -->
    <link href="<?=base_url("assets/css/bootstrap.css")?>" rel="stylesheet"/>
    <style type="text/css">
        body{
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .search{
            width: 120px;
        }
    </style>
    <link href="<?=base_url("assets/css/bootstrap-responsive.css")?>" rel="stylesheet" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url("assets/ico/apple-touch-icon-144-precomposed.png")?>" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url("assets/ico/apple-touch-icon-114-precomposed.png")?>" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url("assets/ico/apple-touch-icon-72-precomposed.png")?>" />
    <link rel="apple-touch-icon-precomposed" href="<?=base_url("assets/ico/apple-touch-icon-57-precomposed.png")?>" />
    <link rel="shortcut icon" href="<?=base_url("assets/ico/favicon.png")?>" />

<script>
    function searchByBook(){
        value = encodeURIComponent($("#searchbook").val());
        document.location.href="http://localhost/TTS/View/SearchByName/" + $("#searchbook").val();
    }
    
    function searchByISBN(){
        value = encodeURIComponent($("#searchbook").val());
        document.location.href="http://localhost/TTS/View/SearchByISBN/" + $("#searchbook").val();
    }
    
    function searchByAuthor(){
        value = encodeURIComponent($("#searchbook").val());
        document.location.href="http://localhost/TTS/View/SearchByAuthor/" + $("#searchbook").val();
    }
    
    function searchByBooksellers(){
        value = encodeURIComponent($("#searchbook").val());
        document.location.href="http://localhost/TTS/View/SearchByBooksellers/" + $("#searchbook").val();
    }
</script>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="<?=base_url()?>">台客書店</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?
                            foreach($list as $item)
                            {
                                $tag = $item["Tag"];
                                $url = base_url().$item["Url"];
                                $active = isset($item["Active"])? $item["Active"] : null;
                                echo "<li class='$active'>";
                                echo "<a href='$url'>$tag</a>";
                                echo "</li>";
                            }
                        ?>
                        <li>
                            <form class="navbar-search pull-left">
                                <input type="text" id="searchbook" class="search-query search" placeholder="關鍵字"/>
                                <input type="hidden" id="searchmode" />
                            </form>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-search"></i></a>
                            <ul class="dropdown-menu">
                                <li class="divider"></li>
                                <li class="nav-header">搜尋模式</li>
                                <li class="divider"></li>
                                <li><a href="#" onclick="searchByBook()">書名</a></li>
                                <li><a href="#" onclick="searchByISBN()">ISBN</a></li>
                                <li><a href="#" onclick="searchByAuthor()">作者</a></li>
                                <li><a href="#" onclick="searchByBooksellers()">出版社</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                    </ul>
                    <?if(!$isLogin){?>
                        <form class="navbar-form pull-right" action="<?=base_url("Func/Login")?>" method="post">
                            <input class="span2" name="email" type="text" placeholder="Email" />
                            <input class="span2" name="passwd" type="password" placeholder="Password" />
                            <button type="submit" class="btn">Sign in</button>
                        </form>
                    <?}else{?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><?=$username?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="divider"></li>
                                <li><a href="<?=base_url("ViewMember/Me/Info")?>">會員資料</a></li>
                                <li><a href="<?=base_url("ViewMember/Me/Password")?>">修改密碼</a></li>
                                <li><a href="<?=base_url("Func/Logout")?>">登出</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=base_url("ViewMember/Me/Transaction")?>">交易紀錄</a></li>
                                <li><a href="<?=base_url("ViewMember/Me/Concern")?>">關注書單</a></li>
                                <li><a href="<?=base_url("ViewMember/Me/ShopCar")?>">購物車</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                    </ul>
                    <?}?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <script>
        function showReminderMsg(msg)
        {
            $("#reminder").modal('show');
            $("#reminderMsg").html(msg);
        }
    </script>
    
    <div id="reminder" class="modal hide fade in">
        <div class="modal-header">
            <h3>溫馨提醒</h3>
        </div>
        <div class="modal-body">
            <h4 class="red" align="center" id="reminderMsg"><h4>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">我知道了</button>
        </div>
    </div>