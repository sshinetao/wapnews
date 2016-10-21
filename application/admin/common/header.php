<?php
include_once '../conf/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link = connect ();
if (! is_admin_login( $link )) {
    skip ( 'login.php', '*_* 请先登录！' );
}
?>


<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WAPNEWS 后台管理</title>
  <meta name="description" content="这是一个form页面">
  <meta name="keywords" content="form">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="../../public/assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="../../public/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="../../public/assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="../../public/assets/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>WAPNEWS</strong> <small>后台管理模板</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">

      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">

          <span class="am-icon-users"></span> <?php echo $_SESSION['admin']['admin_login_name']?> <span class="am-icon-caret-down"></span>
        </a>

        <?php
        //var_dump($_SESSION);
        ?>
        <ul class="am-dropdown-content">
          <li><a href="info.php?id=<?php echo $_SESSION['admin']['admin_id']?>&flag=admin"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="logout.php"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="category_add.php"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 分类模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
				         <li><a href="category_list.php"><span class="am-icon-table"></span> 分类列表</a></li>
          <li><a href="category_add.php"><span class="am-icon-table"></span> 添加父分类</a></li>
             <li><a href="category_son_add.php"><span class="am-icon-table"></span> 添加子分类</a></li>
          </ul>
        </li>

		        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 新闻模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
				          <li><a href="news_list.php"><span class="am-icon-table"></span> 新闻列表</a></li>
				              <li><a href="comment_list.php"><span class="am-icon-table"></span> 评论列表</a></li>
          </ul>
        </li>
		 <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 用户 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
				          <li><a href="user_list.php"><span class="am-icon-table"></span> 用户列表</a></li>
				             <li><a href="user_add.php"><span class="am-icon-table"></span> 添加用户</a></li>

          </ul>
        </li>



        <li><a href="#"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
        </div>
      </div>


    </div>
  </div>
  <!-- sidebar end -->