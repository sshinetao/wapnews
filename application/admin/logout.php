<?php
include_once '../conf/mysql.inc.php';
include_once 'inc/tool.inc.php';
$title = '退出后台登录';

$link = connect ();
$admin_id = is_admin_login($link);
 if (!is_admin_login ( $link )) {

 header('Location:login.php');

 }
 session_unset();
 session_destroy();
header('Location:login.php');