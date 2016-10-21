<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/tool.inc.php';
/* var_dump($_COOKIE['user']['user_login_name']);
var_dump($_COOKIE['user']['user_password']); */
$link = connect ();
$user_id = is_user_login($link);
if ($user_id ) {
	skip ( 'index.php', '*_* 不要重复登陆！' );
}
if (isset($_POST['submit'])) {

    include_once 'conf/login_check.inc.php';
    escape($link, $_POST);
    $query = "
	    select * from wap_user where
	user_login_name = '{$_POST['user_login_name']}'
	and user_password = md5('{$_POST['user_password']}') ";
    // var_dump($query);exit();
    $result = execute($link, $query);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        setcookie('user[user_id]', $data['user_id']);
        setcookie('user[user_name]', $data['user_name']);
        setcookie('user[user_touxiang]', $data['user_touxiang']);
        setcookie('user[user_login_name]', $data['user_login_name']);
        setcookie('user[user_password]', sha1($data['user_password']));
        $query= "update wap_user set user_last_time = now() where user_login_name ='{$data['user_login_name']}'";
        $result = execute($link, $query);
        skip('index.php', '^_^ 登录成功！');
    } else {
        skip('login.php', '*_* 登录失败，用户名或密码错误！');
    }
}

$title = '登录';

?>
<?php include_once 'common/header.inc.php';?>
<script>
  		function changepic(){
		  var img = document.getElementById("checkpic").src="common/verify_code.php?id="+Math.random()*10;
 		 return;
				}
</script>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active">登录</li>
</ol>


<article class="am-paragraph am-paragraph-default">
	<div class="am-g" id="reply">
		<div class="am-u-md-12 am-u-sm-centered">
			<form class="am-form" method="post" data-am-validator id="iform">
				<fieldset class="am-form-set">
					<div class="am-form-group am-form-icon">
						<i class="am-icon-user"></i> <input type="text"
							class="am-form-field" placeholder="用户名" name="user_login_name"
							minlength="5" required >
					</div>
					<div class="am-form-group am-form-icon">
						<i class="am-icon-lock"></i> <input type="password"
							class="am-form-field" placeholder="密码" name="user_password" minlength="5">
					</div>
					<div class="am-form-group am-form-icon">
						<i class="am-icon-barcode"></i> <input type="text"
							class="am-form-field " placeholder="验证码" name="verify"
							minlength="4">
					</div>
					<img onclick="changepic();" id="checkpic" alt="点击刷新"
						src="common/verify_code.php">

				</fieldset>
				<button type="submit" name="submit"
					class="am-btn am-btn-primary am-btn-block am-radius">登录</button>
				<a href="register.php"
					class="am-btn am-btn am-btn-success am-btn-block am-radius" style="color: white">去注册</a>
			</form>
		</div>
	</div>
</article>
















<?php include_once 'common/footer.inc.php';?>