<?php
include_once 'inc/mysql.inc.php';
include_once 'inc/page.inc.php';
$link = connect ();
$query = "select * from wap_content,wap_module 
		where wap_content.cid = {$_GET['id']} and
		wap_content.module_id = wap_module.mid ";

$result = execute ( $link, $query );
$data = mysqli_fetch_assoc ( $result );

$query_user = "select * from wap_user where uid = {$data['user_id']}";
$result_user = execute ( $link, $query_user );
$data_user = mysqli_fetch_assoc ( $result_user );

$query_count = "select count(*) from wap_reply where content_id = {$data['cid']}";
$count = num ( $link, $query_count );

?>
<?php

$title = $data ['title'];
include_once 'inc/header.inc.php';
?>

<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li><a href="cate_list.php?id=<?php echo $data['mid'] ?>"><?php echo $data['mname']?> </a></li>
	<li class="am-active">帖子</li>
</ol>
<?php
if (! isset ( $_GET ['page'] ) || $_GET ['page'] == 1) {
	?>
<article data-am-widget="paragraph"
	class="am-paragraph am-paragraph-default"
	data-am-paragraph="{ tableScrollable: true, pureview: true }">
	<h2><?php echo $data['title'] ?></h2>

	<h4>


		<a href="member.php">		
			<?php echo $data_user['uname'] ?></a>			
			 &nbsp; 发表于  &nbsp;  <?php echo date('y/m/d H:i',strtotime($data['ctime']))?> &nbsp; <a
			href="#reply"> <span class="am-icon-comments"></span> &nbsp; <?php echo $count?></a>
	</h4>
	<p class=paragraph-default-p>
		<?php echo $data['ccontent']?>
	</p>
	<div class="am-vertical-align am-fr" style="height: 40px;">
		<div class="am-vertical-align-bottom">
		
		<?php 
		$query_wm = "select * from wap_module,wap_user where wap_module.mid = {$data['mid']} and wap_module.wm_id = wap_user.uid";
		
		$result_wm = execute($link, $query_wm);
		$data_wm = mysqli_fetch_assoc($result_wm);
		if (is_login($link)){
		if (($data_wm['uname']==$_COOKIE['wap']['uname'])||($_COOKIE['wap']['uname']==$data_user['uname'])){
		?>
			<button class="am-btn am-btn-danger am-round">
				<span class="am-icon-trash"> 删除</span>
			</button>
			<button class="am-btn am-btn-warning am-round">
				<span class="am-icon-edit"> 编辑</span>
			</button>
			
			<?php }}?>
			<button onclick="goBottom()" class="am-btn am-btn-default am-round">
				<span class="am-icon-reply"> 回复</span>
			</button>
		</div>
	</div>
</article>
<?php }?>
<br>
<br />

<article data-am-widget="paragraph"
	class="am-paragraph am-paragraph-default"
	data-am-paragraph="{ tableScrollable: true, pureview: true }">
	<!-- 评论容器 -->
	<h3>回复列表：</h3>
	
	<?php
	$page_size = 2;
	$page = page ( $count, $page_size );
	$query = "select * from wap_user,wap_reply where wap_reply.content_id = {$data['cid']} and
		wap_reply.user_id = wap_user.uid order by rid  {$page['limit']}";
	$result = execute ( $link, $query );
	$i = 1;
	if (isset ( $_GET ['page'] )) {
		$i = ($_GET ['page'] - 1) * $page_size + 1;
		while ( $data = mysqli_fetch_assoc ( $result ) ) {
			
			?>
	<div class="am-panel am-panel-secondary">
<a href="member.php?id=<?php echo $data['uid'] ?>"><img src="public/assets/images/1.jpg" width="32" height="32"
alt="<?php echo $data['uname'] ?>" class="am-fl am-img-thumbnail am-circle" >  </a>
		<div class="am-panel-hd">
			<b><a href="member.php?id=<?php echo $data['uid'] ?>"><?php echo $data['uname'] ?></a></b>
			&nbsp;<small><?php echo $data['rtime'] ?></small> <a class=" am-fr"><?php echo $i++?>#</a>
		</div>
		<div class="am-panel-bd">
		
		<?php
			if ($data ['quote_id']) {
				$query_quote = "select * from wap_reply ,wap_user where wap_reply.user_id = wap_user.uid and wap_reply.rid = {$data['quote_id']} ";
				
				$result_quote = execute ( $link, $query_quote );
				$data_quote = mysqli_fetch_assoc ( $result_quote );
				?>
		<blockquote>
				<p>
					<b>引用</b>： <a><?php echo $data_quote['uname']?></a> &nbsp; <?php echo $data_quote['rtime'] ?></p>
				<p><?php echo $data_quote['rcontent']?></p>
			</blockquote>
			<hr data-am-widget="divider" style=""
				class="am-divider am-divider-dashed" />
		
		<?php }?>
		
		<?php echo $data['rcontent']?>
		<div class="am-vertical-align" style="height: 20px;">
				<div class="am-vertical-align-bottom am-fr">
					<a class="am-fr"
						href="quote.php?id=<?php echo $_GET['id'] ?>&rid=<?php echo $data['rid'] ?>"><span
						class="am-icon-reply"></span></a>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
	}
	?>
	
	<ul class="am-pagination am-pagination-centered">
		<?php
		echo $page ['html'];
		?>
	</ul>
</article>
<br>
<br />
<article class="am-paragraph am-paragraph-default">
	<div class="am-g" id="reply">
		<div class="am-u-md-12 am-u-sm-centered">
			<form class="am-form">
		<?php
			/*
		 * 判断是否登录，显示相应框框
		 */
		$user_id = is_login ( $link );
		if (isset ( $user_id ) && ($user_id != '')) {
			?>
				<fieldset class="am-form-set">
					<textarea rows="5" cols=""></textarea>
				</fieldset>
				<button type="submit" class="am-btn am-btn-primary ">回复</button>
				<?php }else{?>
				<fieldset class="am-form-set">
					<textarea rows="5" cols="">请登录后再发表评论</textarea>
				</fieldset>
				<button type="submit" disabled="disabled"
					class="am-btn am-btn-primary ">回复</button>

				<?php }?>

			</form>
		</div>
	</div>

</article>








<script>function goBottom() {
window.scrollTo(0, document.documentElement.scrollHeight-document.documentElement.clientHeight); 
}</script>



<?php include_once 'inc/footer.inc.php';?>