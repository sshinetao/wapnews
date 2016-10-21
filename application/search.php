<?php


include_once 'conf/mysql.inc.php';
$link = connect();


?>
<?php
$title =  '搜索';
include_once 'common/header.inc.php';

?>

<ol style="padding-left: 10px" class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active">搜索</li>
</ol>

<form action="" method="get">
<div class="am-u-lg-12" style="padding:0 10px">
    <div class="am-input-group am-input-group-primary">
    <input name="keywords" type="text" class="am-form-field" placeholder="请输入关键字进行搜索">
      <span class="am-input-group-btn">
        <button class="am-btn am-btn-primary" name="search" type="submit"><span class="am-icon-search"></span></button>
      </span>

    </div>
  </div>
</form>

<br /><br />
<?php
if (isset($_GET['search'])){
?>
<div data-am-widget="list_search"
	class="am-list-news am-list-news-default">
	<!--列表标题-->

	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<!--带更多链接-->
		<h2 class="am-titlebar-title ">
			<a
				class=""><?php echo $_GET['keywords']?></a>

		</h2>


	</div>

	<div class="am-list-news-bd">

		<ul style="padding-left: 5px" class="am-list" >
					<?php


    $query_search = "
SELECT
a.content_id AS content_id,
a.content_title AS content_title,
a.content_content AS content_content,
a.content_post_time AS post_time,
a.content_last_time AS last_time,
Count(b.comment_id) AS comment_count
FROM
wap_news_content AS a
INNER JOIN wap_news_comment AS b ON a.content_id = b.comment_content_id
WHERE
a.content_title LIKE '%{$_GET['keywords']}%' OR
a.content_content LIKE '%{$_GET['keywords']}%'
GROUP BY
a.content_id,
a.content_title,
a.content_content,
a.content_category_id,
a.content_author_id,
a.content_post_time,
a.content_last_time
";
    //var_dump($query_search);
    $result_search = execute($link, $query_search);
    while ($data_search = mysqli_fetch_assoc($result_search)) {
        ?>
			<li class="am-g am-list-item-dated"><a
				href="news.php?id=<?php echo $data_search['content_id'] ?>"
				class="am-list-item-hd ">
			<?php echo $data_search['content_title']?>
			</a>

				<span style="margin-right: 80px" class="am-list-date"> <?php echo date('Y/m/d',strtotime($data_search['post_time'])) ?> &nbsp;

				</span>
				<span  class="am-list-date"><span class="am-icon-comments"> <?php echo $data_search['comment_count']?></span></span></li>
		<?php } }else{ ?>



		<?php }?>
		</ul>


	</div>
</div>






<?php include_once 'common/footer.inc.php';?>