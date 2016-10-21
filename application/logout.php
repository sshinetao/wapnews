<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/tool.inc.php';
$link = connect ();
$user_id = is_user_login($link);
if (!$user_id ) {
	skip ( 'login.php', '*_* 别逗，你还没登陆！' );
}
setcookie ( 'user[user_login_name]', '', time () - 3600 );
setcookie ( 'user[user_password]', '' ,time()-3600);
skip('index.php', '^_^ 注销成功！');
?>