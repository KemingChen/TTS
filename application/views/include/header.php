<!DOCTYPE html>
<html lang="en">
<head>
    <title>台客書店</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Le styles -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet"/>
    <style type="text/css">
        body
        {
            padding-top: 60px;
            padding-bottom: 40px;
        }
}
    </style>
    <link href="<?=base_url()?>assets/css/bootstrap-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png" />

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
                <a class="brand" href="#">台客書店</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="active"><a href="#">書籍瀏覽</a></li>
                        <li><a href="#about">搜尋...施工中</a></li>
                    </ul>
                <?if(!$isLogin){?>
                    <form class="navbar-form pull-right">
                        <input class="span2" type="text" placeholder="Email" />
                        <input class="span2" type="password" placeholder="Password" />
                        <button type="submit" class="btn">Sign in</button>
                    </form>
                <?}else{?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">會員專區 <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">交易紀錄</a></li>
                                <li><a href="#">關注書單</a></li>
                                <li><a href="#">購物車</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">施工中...</li>
                                <li><a href="#">修改密碼</a></li>
                            </ul>
                        </li>
                    </ul>
                <?}?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>