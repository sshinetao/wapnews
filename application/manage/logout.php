<?php
include_once '../conf/mysql.inc.php';
include_once '../conf/tool.inc.php';
$link = connect ();
$manage_id = is_manage_login($link);
if (!$manage_id ) {
	skip ( 'login.php', '*_* 别逗，你还没登陆！' );
}
setcookie ( 'manage[manage_login_name]', '', time () - 3600 );
setcookie ( 'manage[manage_password]', '' ,time()-3600);
skip('index.php', '^_^ 注销成功！');
?>