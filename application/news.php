<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/page.inc.php';
$link = connect();

$query1 = "select
a.content_id AS acontent_id,
a.content_title AS title,
a.content_content AS content,
a.content_author_id,
a.content_post_time AS post_time,
a.content_last_time AS reply_time,
d.manage_id,
d.manage_name AS name,
a.content_category_id,
b.category_id AS bcategory_id,
b.category_name AS bcategory_name,
b.category_parent_id,
c.category_name AS ccategory_name,
c.category_id AS ccategory_id
FROM
wap_news_content AS a
INNER JOIN wap_news_manage AS d ON a.content_author_id = d.manage_id
INNER JOIN wap_news_category AS b ON a.content_category_id = b.category_id
INNER JOIN wap_news_category AS c ON b.category_parent_id = c.category_id
WHERE a.content_id =  {$_GET['id']}
            ";
//var_dump($query1);
$result1 = execute($link, $query1);
$data1 = mysqli_fetch_assoc($result1);
$query_count_reply = "select * from wap_news_comment where comment_content_id = {$_GET['id']}";
$result_content_reply = execute($link, $query_count_reply);
$count = mysqli_affected_rows($link);
?>
<?php

$title = $data1['title'];
include_once 'common/header.inc.php';
?>

<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li><a href="category.php?id=<?php echo $data1['ccategory_id'] ?>"><?php echo $data1['ccategory_name']?> </a></li>
	<li><a href="category_son.php?id=<?php echo $data1['bcategory_id'] ?>"><?php echo $data1['bcategory_name']?> </a></li>
	<li class="am-active"><?php echo $data1['title']?></li>
</ol>



<?php
if (! isset($_GET['page']) || $_GET['page'] == 1) {
    ?>
<article data-am-widget="paragraph"
	class="am-paragraph am-paragraph-default"
	data-am-paragraph="{ tableScrollable: true, pureview: true }">
	<h2><?php echo $data1['title'] ?></h2>

	<h4>


		<span class="am-icon-user"> &nbsp;<?php echo $data1['name'] ?>&nbsp; </span>


		<span class="am-icon-calculator">&nbsp;<?php echo date('Y/m/d H:i',strtotime($data1['post_time']))?>&nbsp; </span>
		<span class="am-icon-comments">&nbsp;<a href="#reply"><?php echo $count?></a></span>
	</h4>
	<p class=paragraph-default-p>
		<?php echo $data1['content']?>
	</p>
	<div class="am-vertical-align am-fr" style="height: 40px;">
		<div class="am-vertical-align-bottom">




			<button onclick="goBottom()" class="am-btn am-btn-default am-round">
				<span class="am-icon-reply"> 回复</span>
			</button>
		</div>
	</div>
</article>
<?php }?>
<br>
<br />

<?php
if (isset($_POST['reply'])){
   // var_dump($_POST);
    $query_reply = "insert into wap_news_comment
    (
    comment_user_id,comment_content_id,comment_content,comment_parent_id,comment_time
    )
    values
    (
    {$_COOKIE['user']['user_id']},{$_GET['id']},'{$_POST['comment_content']}',0,now()
    )
    ";
    //var_dump($query);
   $result_reply = execute($link, $query_reply);
    if (mysqli_affected_rows($link)==1){
        skip("news.php?id=".$_GET['id'], '^_^ 评论成功！');
    }else {
        skip("news.php?id=".$_GET['id'], '*_* 评论失败！');
    }
}

?>



<article data-am-widget="paragraph"
	class="am-paragraph am-paragraph-default"
	data-am-paragraph="{ tableScrollable: true, pureview: true }">
	<!-- 评论容器 -->



	<h3>回复列表：</h3>

	<?php
$page_size = 10;
$page = page($count, $page_size);
$query = " SELECT
                a.comment_id AS acomment_id,
                a.comment_user_id AS acomment_user_id,
                a.comment_content AS acomment_content,
                a.comment_content_id AS acomment_content_id,
                b.content_id AS bcontent_id,
                a.comment_time AS acomment_time,
                c.user_id as user_id,
                c.user_name as user_name,
                a.comment_parent_id as  acomment_parent_id,
                c.user_touxiang AS touxiang
                FROM
                wap_news_comment AS a
                INNER JOIN wap_news_content AS b ON b.content_id = a.comment_content_id
                INNER JOIN wap_user AS c ON a.comment_user_id = c.user_id
                WHERE
                    b.content_id = {$_GET['id']}
                    order by  a.comment_user_id desc

                 {$page['limit']}";
//var_dump($query);
$result = execute($link, $query);
$i = 1;
if (isset($_GET['page'])) {
    $i = ($_GET['page'] - 1) * $page_size + 1;
    while ($data = mysqli_fetch_assoc($result)) {

        ?>
	<div class="am-panel am-panel-secondary">
		<a href="member.php?id=<?php echo $data['user_id'] ?>"><img
			src="<?php echo $data['touxiang']?>" width="32" height="32"
			alt="<?php echo $data['user_name'] ?>"
			class="am-fl am-img-thumbnail am-circle"> </a>
		<div class="am-panel-hd">
			&nbsp;<b><a href="member.php?id=<?php echo $data['user_id'] ?>"><?php echo $data['user_name'] ?></a></b>
			&nbsp;<small><?php echo $data['acomment_time'] ?></small> <a
				class=" am-fr"><?php echo $i++?>#</a>
		</div>
		<div class="am-panel-bd">

		<?php
        if ($data['acomment_parent_id']) {
            $query_reply = "SELECT
a.comment_id AS acomment_id,
a.comment_parent_id AS acomment_parent_id,
a.comment_time AS acomment_time,
a.comment_content AS acmment_content,
a.comment_user_id AS acomment_user_id,
b.user_id AS buser_id,
b.user_name AS buser_name,
b.user_touxiang AS btouxiang,
c.comment_id AS ccomment_id,
c.comment_content AS ccomment_content,
d.user_name AS duser_name,
d.user_touxiang AS duser_touxiang,
c.comment_user_id,
d.user_id AS duser_id,
c.comment_time AS ccomment_time
FROM
wap_news_comment AS a
INNER JOIN wap_user AS b ON a.comment_user_id = b.user_id
INNER JOIN wap_news_comment AS c ON c.comment_id = a.comment_parent_id
INNER JOIN wap_user AS d ON d.user_id = c.comment_user_id
				where a.comment_id = {$data['acomment_id']} ";
          // var_dump($query_reply);
            $result_reply = execute($link, $query_reply);
            $data_reply = mysqli_fetch_assoc($result_reply);
            ?>
		<blockquote style="margin-top: -10px">
				<p style="font-family: '仿宋';">

					<img
						src="<?php echo $data_reply['duser_touxiang']?>"
						width="32" height="32" alt="<?php echo $data['user_name'] ?>"
						class="am-fl am-img-thumbnail am-circle"> <a style="margin-left: 10px"
						href="member.php?id=<?php echo $data_reply['duser_id'] ?>"><?php echo $data_reply['duser_name']?>
					&nbsp;
					</a> <?php echo $data_reply['ccomment_time'] ?></p>
				<p style="margin-left:40px"><?php echo $data_reply['ccomment_content']?></p>
			</blockquote>
			<hr data-am-widget="divider" style=""
				class="am-divider am-divider-dashed" />

		<?php }?>

		<?php echo htmlspecialchars($data['acomment_content'])?>
		<div  class="am-vertical-align" style="height: 20px;">
				<div class="am-vertical-align-bottom am-fr">
					<a class="am-fr"
href="quote.php?reply_user_id=<?php echo $data['user_id'] ?>&nid=<?php echo $_GET['id'] ?>
&ntitle=<?php echo $data1['title']?>
&cid=<?php echo $data['acomment_id'] ?>
&ccomment_user=<?php echo $data['user_name']?>
&ccontent=<?php echo $data['acomment_content'] ?>"><span
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

	</ul>
</article>
<br>
<br />
<article style="margin:0 -7px " class="am-paragraph am-paragraph-default">
	<div class="am-g" id="reply">
		<div class="am-u-md-12 am-u-sm-centered">
			<form class="am-form" method="post">
		<?php
/*
 * 判断是否登录，显示相应框框
 */
$user_id = is_user_login($link);
if (isset($user_id) && ($user_id != '')) {
    ?>
				<fieldset class="am-form-set">
					<textarea rows="5" name="comment_content" cols=""></textarea>
				</fieldset>
				<button type="submit" name="reply" class="am-btn am-btn-primary ">回复</button>
				<?php }else{?>
				<fieldset class="am-form-set">
					<textarea rows="5" cols="">请登录后再发表评论</textarea>
				</fieldset>
				<button type="submit" disabled="disabled"
					class="am-btn am-btn-primary " >回复</button>

				<?php }?>

			</form>
		</div>
	</div>

</article>







<script>function goBottom() {
window.scrollTo(0, document.documentElement.scrollHeight-document.documentElement.clientHeight);
}</script>



<?php include_once 'common/footer.inc.php';?>