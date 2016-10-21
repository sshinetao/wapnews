<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/tool.inc.php';
$link = connect();

$title = "未读消息 - 收件箱 - 个人中心";
?>
<?php include_once 'common/header.inc.php';?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li><a href="member.php?id=<?php echo $_COOKIE['user']['user_id']?>">个人中心</a></li>
	<li><a href="message.php?id=<?php echo $_COOKIE['user']['user_id']?>">收件箱</a></li>
	<li class="am-active">未读消息</li>
</ol>
<div data-am-widget="list_news"
	class="am-list-news am-list-news-default">
	<!--列表标题-->
	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<h2 class="am-titlebar-title ">
 <?php  ?>收件箱 <span class="am-icon-envelope-o"></span>
		</h2>
		<nav class="am-titlebar-nav">
			<a href="#more-1" class="">帖子</a> <a href="#more-2" class="">资料</a>
		</nav>
	</div>


	<br />





	<ul class="am-pagination am-pagination-centered">
		<li class="am-disabled"><a href="#">&laquo;</a></li>
		<li class="am-active"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">&raquo;</a></li>
	</ul>
</div>
<?php include_once 'common/footer.inc.php';?>