<?php


include_once 'conf/mysql.inc.php';
$link = connect();

$query = "select * from wap_news_category where category_id = {$_GET['id']}";
$result = execute($link, $query);
$data = mysqli_fetch_assoc($result);
$query_category = "select * from wap_news_category where category_parent_id = {$_GET['id']} order by category_porder,category_id desc";
//var_dump($query_category);
$result_category = execute($link, $query_category);
$data_category = mysqli_fetch_assoc($result_category);
//var_dump($data_category['category_id']);
?>
<?php
$title =  $data['category_name'];
include_once 'common/header.inc.php';

?>

<ol style="padding-left: 10px" class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active"><?php echo $data['category_name']?></li>
</ol>


<?php
$query_category_son = "select * from wap_news_category where
category_parent_id ={$_GET['id']} order by category_porder,category_id desc";
//var_dump($query_category_son);
$result_category_son = execute($link, $query_category_son);
while ($data_category_son = mysqli_fetch_assoc($result_category_son)) {
    ?>

<div data-am-widget="list_news"
	class="am-list-news am-list-news-default">
	<!--列表标题-->

	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<!--带更多链接-->
		<h2 class="am-titlebar-title ">
			<a
				href="category_son.php?id=<?php echo $data_category_son['category_id'] ?>"
				class=""><?php echo $data_category_son['category_name'] ?></a>

		</h2>


	</div>

	<div class="am-list-news-bd">

		<ul style="padding-left: 5px" class="am-list" >
					<?php
    $query_news = "select * from wap_news_content where content_category_id ={$data_category_son['category_id']}";
    //var_dump($query_news);
    $result_news = execute($link, $query_news);
    while ($data_news = mysqli_fetch_assoc($result_news)) {
        ?>
			<li class="am-g am-list-item-dated"><a
				href="news.php?id=<?php echo $data_news['content_id'] ?>"
				class="am-list-item-hd ">
			<?php echo $data_news['content_title']?>
			</a>

				<span class="am-list-date"><small><?php echo date('m/d',strtotime($data_news['content_post_time'])) ?></small></span></li>
		<?php }?>
		</ul>


	</div>
</div>

<?php }?>




<?php include_once 'common/footer.inc.php';?>