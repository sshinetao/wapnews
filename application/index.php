<?php
include_once 'conf/mysql.inc.php';
$link = connect();
?>
<?php
$title = '首页';
include_once 'common/header.inc.php';

?>
<nav data-am-widget="menu" class="am-menu  am-menu-default">
	<a href="javascript: void(0)" class="am-menu-toggle"> <i
		class="am-menu-toggle-icon am-icon-bars"></i>
	</a>
	<ul class="am-menu-nav am-avg-sm-3">
		<?php
$query = "select * from wap_news_category where category_parent_id =0 order by category_porder,category_id desc ";
$result = execute($link, $query);
while ($data = mysqli_fetch_assoc($result)) {
    ?>
			<li class="am-parent"><a
			href="#" class=""><?php echo $data['category_name']?></a>
			<ul class="am-menu-sub am-collapse  am-avg-sm-2 ">
			        <?php
    $query_category_son = "select * from wap_news_category where category_parent_id ={$data['category_id']} order by category_porder,category_id desc";
    $result_category_son = execute($link, $query_category_son);
    while ($data_category_son = mysqli_fetch_assoc($result_category_son)) {
        ?>
                  <li class=""><a href="category_son.php?id=<?php  echo $data_category_son['category_id']?>" class=""><?php  echo $data_category_son['category_name']?> </a>
				</li>
					<?php
    }
    ?>
                  <li class="am-menu-nav-channel"><a
					href="category.php?id=<?php echo $data['category_id'] ?>" class=""
					title="<?php echo $data['category_name']?>"><b>进入</b><?php echo $data['category_name']?> &raquo;</a></li>
			</ul></li>
		<?php }?>
		</ul>

</nav>
<!-- <div class="am-slider am-slider-default" data-am-flexslider>
	<ul class="am-slides">
		<li><img src="../public/assets/images/bing-1.jpg" />
			<div class="am-slider-desc">NBA圣诞大战</div></li>
		<li><img src="../public/assets/images/bing-2.jpg" />
			<div class="am-slider-desc">CBA也凑热闹</div></li>
		<li><img src="../public/assets/images/bing-3.jpg" />
			<div class="am-slider-desc">这个写啥</div></li>
		<li><img src="../public/assets/images/bing-4.jpg" />
			<div class="am-slider-desc">胡乱写吧</div></li>
	</ul>
</div> -->










<?php
$query_category = "select * from wap_news_category where category_parent_id =0 order by category_porder,category_id desc";
$result_category = execute($link, $query_category);
while ($data_category = mysqli_fetch_assoc($result_category)) {
    ?>

<div data-am-widget="list_news"
	class="am-list-news am-list-news-default">
	<!--列表标题-->

	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<!--带更多链接-->
		<h2 class="am-titlebar-title ">
			<a
				href="category.php?id=<?php echo $data_category['category_id'] ?>"
				class=""><?php echo $data_category['category_name'] ?></a>

		</h2>
		<nav class="am-titlebar-nav">
<?php
    $query_category_son = "select * from wap_news_category where category_parent_id ={$data_category['category_id']} order by category_porder,category_id desc limit 4";
    $result_category_son = execute($link, $query_category_son);
    while ($data_category_son = mysqli_fetch_assoc($result_category_son)) {
        ?>
        <a href="category_son.php?id=<?php  echo $data_category_son['category_id']?>"
				class=""><?php  echo $data_category_son['category_name']?></a>

<?php
    }
    ?>
			<a
				href="cate_list.php?id=<?php echo $data_category['category_id'] ?>"
				class="">更多 &raquo;</a>
		</nav>
	</div>

	<div class="am-list-news-bd">




		<ul style="padding-left: 5px" class="am-list" >
					<?php
    $query_news = "select * from wap_news_content where content_category_id in
            (select category_id from wap_news_category where category_parent_id = {$data_category['category_id']} )";
    // var_dump($query_news);
    $result_news = execute($link, $query_news);
    while ($data_news = mysqli_fetch_assoc($result_news)) {
        ?>
			<li class="am-g am-list-item-dated"><a
				href="news.php?id=<?php echo $data_news['content_id'] ?>"
				class="am-list-item-hd ">
			<?php echo $data_news['content_title']?>
			</a>
							<span class="am-list-date"><small> <?php echo date('m/d',strtotime($data_news['content_post_time'])) ?></small></span></li>
		<?php }?>
		</ul>


	</div>
</div>

<?php }?>




<?php include_once 'common/footer.inc.php';?>