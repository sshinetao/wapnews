<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/page.inc.php';
$link = connect();

$title = "的个人中心";
?>
<?php include_once 'common/header.inc.php';?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active">个人资料</li>
</ol>
<div data-am-widget="list_news"
	class="am-list-news am-list-news-default">
	<!--列表标题-->
	<div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
		<h2 class="am-titlebar-title ">
			资料 <span class="am-icon-info"></span>
		</h2>
		<nav class="am-titlebar-nav">
			<a href="message.php?id=<?php echo $_COOKIE['user']['user_id']?>"
				class="">提醒</a>
		</nav>
	</div>
</div>

<?php
if (isset($_POST['submit'])){
    if(is_uploaded_file($_FILES['user_touxiang']['tmp_name'])){
        $file= pathinfo($_FILES['user_touxiang']['name']);

        $file_save_path = '../public/touxiang/'.date('YmdHis',time()).rand(1000,9999).'.'.$file['extension'];

        move_uploaded_file($_FILES['user_touxiang']['tmp_name'], $file_save_path);

        $query = "update wap_user set
        user_touxiang = '{$file_save_path}',
        user_name='{$_POST['user_name']}',
		user_password = md5('{$_POST['user_password']}')
        where user_id = {$_COOKIE['user']['user_id']}
		";
        //var_dump($query);exit();
         execute($link, $query);
        if (mysqli_affected_rows($link)==1){
            skip("info.php?id=".$_COOKIE['user']['user_id'],'更新成功！');
        }else{
            skip("info.php?id=".$_COOKIE['user']['user_id'],'更新失败！');
        }
}
}



?>



<div class="am-g">
	<div class="am-u-sm-3 am-u-sm-centered">
		<img class="am-img-thumbnail am-radius" alt="140*140"
			src="<?php echo $_COOKIE['user']['user_touxiang']?>"
			width="140" height="140" />
	</div>
</div>
<div class="am-g">

	<div class="am-u-md-8 am-u-sm-centered">
	<?php
$query = "select * from wap_user where user_id = {$_COOKIE['user']['user_id']}";
$result = execute($link, $query);
while ($data = mysqli_fetch_assoc($result)){
?>
		<form class="am-form" method="post" enctype="multipart/form-data">
			<fieldset class="am-form-set">
				<input type="text" name="user_name" value="<?php echo $data['user_name']?>"> <input type="password"
					name="user_password">
				<div class="am-form-group am-form-file">
					<button type="button" class="am-btn am-btn-danger am-btn-block">
						<i class="am-icon-cloud-upload"></i> 选择要上传的文件
					</button>
					<input id="doc-form-file" type="file" name="user_touxiang">
				</div>
				<div  id="file-list" ></div>
			</fieldset>
			<button type="submit" name="submit"
				class="am-btn am-btn-primary am-btn-block">保存更改</button>
		</form>
		<?php }?>
	</div>
</div>
<script>
  $(function() {
    $('#doc-form-file').on('change', function() {
      var fileNames = '';
      $.each(this.files, function() {
        fileNames += '<span class="am-badge">' + this.name + '</span> ';
      });
      $('#file-list').html(fileNames);
    });
  });
</script>
<?php include_once 'common/footer.inc.php';?>