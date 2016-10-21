<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/page.inc.php';
$link = connect();

$title = "的个人中心";
?>
<?php include_once 'common/header.inc.php';?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active">收件箱</li>
</ol>
<div data-am-widget="list_news"
	class="am-list-news am-list-news-default">
	<!--列表标题-->
	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<h2 class="am-titlebar-title ">
 <?php  ?>收件箱 <span class="am-icon-envelope-square"></span>
		</h2>
		<nav class="am-titlebar-nav">
			 <a href="info.php?id=<?php echo $_COOKIE['user']['user_id']?>" class="">资料</a>
		</nav>
	</div>


	<br />
	<div class="am-tabs" data-am-tabs>
		<ul class="am-tabs-nav am-nav am-nav-tabs">
			<li class="am-active"><a href="#tab1"><span class="am-icon-envelope">
						未读 </span></a></li>
			<li><a href="#tab2"><span class="am-icon-envelope-o"> 已读 </span></a></li>
		</ul>

		<div class="am-tabs-bd">
			<div class="am-tab-panel am-fade am-in am-active" id="tab1">
						<?php
						$query  = "select COUNT(*) from wap_message where message_to_id = {$_COOKIE['user']['user_id']} and message_isread = 0";
						$count = num($link, $query);
						$page_size = 5;
						$page = page($count, $page_size);
						  $query = "SELECT
                            a.message_news_id AS news_id,
                            a.message_time AS time,
                            a.message_isread,
                            a.message_content AS message,
                            b.user_name AS from_name,
                            b.user_id AS from_id,
                            c.content_id,
                            c.content_title,
                            a.message_id,
                            a.message_to_id
                            FROM
                            wap_message AS a
                            INNER JOIN wap_user AS b ON b.user_id = a.message_from_id
                            INNER JOIN wap_news_content AS c ON c.content_id = a.message_news_id
                            WHERE message_to_id={$_COOKIE['user']['user_id']} and a.message_isread = 0  {$page['limit']}";
						  //var_dump($query);
						  $result =execute($link, $query);
						  while($data = mysqli_fetch_assoc($result)){
						?>
				<div class="am-panel am-panel-default">
					<div class="am-panel-bd class="am-text-truncate"">
						<small><?php echo $data['time']?></small><br /> <a><?php echo $data['from_name']?></a> 在 <a href="news.php?id=<?php echo $data['content_id']?>"><?php echo $data['content_title']?></a><br />
						回复你：
						<a ><?php echo $data['message']?></a>
					</div>
				</div>
				<?php						  }
						?>




				</div>
			</div>
			<div class="am-tab-panel am-fade" id="tab2">

						<?php
						$query  = "select COUNT(*) from wap_message where message_to_id = {$_COOKIE['user']['user_id']} and message_isread = 1";
						$count = num($link, $query);
						$page_size = 5;
						$page = page($count, $page_size);
						  $query = "SELECT
                                a.message_news_id AS news_id,
                                a.message_time AS time,
                                a.message_isread,
                                a.message_content AS message_content,
                                b.user_name AS from_name,
                                b.user_id AS from_id,
                                c.content_id,
                                c.content_title,
                                a.message_id,
                                a.message_to_id
                                FROM
                                wap_message AS a
                                INNER JOIN wap_user AS b ON b.user_id = a.message_from_id
                                INNER JOIN wap_news_content AS c ON c.content_id = a.message_news_id
                                WHERE message_to_id= {$_COOKIE['user']['user_id']} and a.message_isread = 1  {$page['limit']}";
						  //var_dump($query);
						  $result =execute($link, $query);
						  while($data = mysqli_fetch_assoc($result)){
						?>
				<div class="am-panel am-panel-default">
					<div class="am-panel-bd class="am-text-truncate"">
						<small><?php echo $data['time']?></small><br /> <a><?php echo $data['from_name']?></a> 在 <a href="news.php?id=<?php echo $data['content_id']?>"><?php echo $data['content_title']?></a><br />
						回复你：
						<a ><?php echo $data['message']?></a>
					</div>
				</div>
			<?php
						  }
						?>


			</div>
		</div>


	<ul class="am-pagination am-pagination-centered">
		<?php
echo $page['html'];
?>
	</ul>
</div>
<?php include_once 'common/footer.inc.php';?>