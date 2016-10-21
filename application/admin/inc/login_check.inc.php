<?php

if (empty($_POST['admin_login_name'])){
	skip('login.php', '*_* 用户名不能为空！');
}
if (mb_strlen($_POST['admin_login_name'])>32){
	skip('login.php', '*_* 用户名长度不能大于32！');
}
if (mb_strlen($_POST['admin_login_name'])<5){
	skip('login.php', '*_* 用户名长度不能小于5！');
}
if (empty($_POST['admin_password'])){
	skip('login.php', '*_* 密码不能为空！');
}
if (!isset($_POST['verify'])){
	skip('login.php', "*_* 请输入验证码！");
}
if (strtolower($_POST['verify'])!=strtolower($_SESSION['code'])){
	skip('login.php', "*_* 验证码输入错误！");
}



