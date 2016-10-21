<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/tool.inc.php';

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $title ?> - <?php echo SITE_VERSION ?> - Powered by &nbsp; <?php echo SITE_NAME ?></title>

<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">

<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="icon" type="image/png" href="../public/assets/i/favicon.png">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" sizes="192x192"
	href="../public/assets/i/app-icon72x72@2x.png">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="Amaze UI" />
<link rel="apple-touch-icon-precomposed"
	href="../public/assets/i/app-icon72x72@2x.png">

<!-- Tile icon for Win8 (144x144 + tile color) -->
<meta name="msapplication-TileImage"
	content="../public/assets/i/app-icon72x72@2x.png">
<meta name="msapplication-TileColor" content="#0e90d2">

<link rel="stylesheet" href="../public/assets/css/amazeui.min.css">
<link rel="stylesheet" href="../public/assets/css/app.css">

<script src="../public/assets/js/handlebars.min.js"></script>
<script src="../public/assets/js/jquery.min.js"></script>
<script src="../public/assets/js/amazeui.min.js"></script>
</head>
<body>

	<header data-am-widget="header" class="am-header am-header-default "
		data-am-sticky>
		<div class="am-header-left am-header-nav">
			<a href="index.php" class=""> <?php echo SITE_NAME ?> </a>
		</div>




<?php
$link = connect();
$user_id = is_user_login($link);
if (isset($user_id) && ($user_id != '')) {
    $ask = date('H');
    $say = '';
    switch ($ask) {
        case '07':
        case '08':
        case '09':
        case '10':
        case '11':
            $say = '上午好';
            break;
        case '12':
        case '13':
            $say = '中午好';
            break;
        case '14':
        case '15':
        case '16':
        case '17':
        case '18':
            $say = '下午好';
            break;
        case '19':
        case '20':
        case '21':
        case '22':
            $say = '晚上好';
            break;
        default:
            $say = '不要熬夜哦';
            break;
    }
    $_COOKIE['user']['user_name'];
    $A = <<<A
		<h1 class="am-fr"><a href="#right" data-am-offcanvas > <img  style="margin-bottom:5px" width="40px" src="{$_COOKIE['user']['user_touxiang']}" class=" am-circle" alt="{$_COOKIE['user']['user_name']}" /></a></h1>
		<div class="am-header-right am-header-nav">



				<!-- 侧边栏内容 -->
			<div id="right" class="am-offcanvas">
			  <div class="am-offcanvas-bar am-offcanvas-bar-flip">
			    <div class="am-offcanvas-content">

				<ul class="am-menu-nav am-avg-sm-1">
				<li><h1><a >{$_COOKIE['user']['user_name']}，{$say} ！</a></h1></li>
				<li><a href="search.php" class=""> <i class="am-header-icon am-icon-search"></i> &nbsp; 搜索中心	</a> </li>
		      	<li ><a href="info.php?id={$_COOKIE['user']['user_id']}" ><i class="am-header-icon am-icon-user"></i> &nbsp; 个人空间</a></li>
			      	<li><a href="logout.php" ><i class="am-header-icon am-icon-sign-out"></i> &nbsp; 注销登录</a></li>
				</ul>
			    </div>
			  </div>
			</div>




A;

    echo $A;
} else {
    $B = <<<A
	<div class="am-header-right am-header-nav">
<a href="login.php"><i class="am-header-icon am-icon-sign-in"></i>
			</a>

A;
    echo $B;
}

?>







		</div>
	</header>