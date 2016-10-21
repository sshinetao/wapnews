<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/page.inc.php';
$link = connect();
//var_dump($_COOKIE['user']);
?>

<?php include_once 'common/header.inc.php';?>


<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li><a href="news.php?id=<?php echo $_GET['nid'] ?>"><?php echo $_GET['ntitle'] ?></a></li>
	<li class="am-active">回复</li>
</ol>


<?php
if (isset($_POST['quote'])) {
    $query = "insert into wap_news_comment
    (
    comment_user_id,comment_content_id,comment_content,comment_parent_id,comment_time
    )values
    (
       {$_COOKIE['user']['user_id']},{$_GET['nid']},'{$_POST['quote_content']}',{$_GET['cid']},now()
    )";
    // var_dump($query);
    $result = execute($link, $query);
    if (mysqli_affected_rows($link) == 1) {
        $query = "insert into wap_message (message_from_id,message_to_id,message_content,message_news_id,message_time)values({$_COOKIE['user']['user_id']},{$_GET['reply_user_id']},'{$_POST['quote_content']}',{$_GET['nid']},now())";
        // var_dump($query);exit();
        execute($link, $query);

        skip("news.php?id=" . $_GET['nid'], '^_^ 回复成功！');
    } else {
        skip("news.php?id=" . $_GET['nid'], '*_* 回复失败！');
    }
}
?>

<article style="margin-left: -5px"
	class="am-paragraph am-paragraph-default">
	<div class="am-g" id="reply">
		<div class="am-u-md-12 am-u-sm-centered">
			<blockquote>
				<p>
					<b>回复</b>： <a
						href="member.php?id=<?php echo $_GET['reply_user_id'] ?>"><?php echo $_GET['ccomment_user'] ?></a> &nbsp; <?php echo $_GET['ccontent']?>
			</p>

			</blockquote>
			<hr data-am-widget="divider" style=""
				class="am-divider am-divider-dashed" />
			<form class="am-form" method="post">
				<fieldset class="am-form-set">
					<textarea name="quote_content" rows="5" cols=""></textarea>
				</fieldset>
				<button type="submit" name='quote' class="am-btn am-btn-primary ">回复</button>
			</form>
		</div>
	</div>
</article>










<?php  include_once 'common/footer.inc.php'; ?>