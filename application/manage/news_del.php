<?php

include_once '../conf/mysql.inc.php';
include_once '../conf/tool.inc.php';
$link = connect ();
if(!is_manage_login($link)){
    skip('../index.php', '没有权限！');
}

if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
	skip ( 'news_list.php', '*_*id不存在,删除失败！' );
}

$query = "delete from wap_news_content where content_id = '{$_GET['id']}'";
execute ( $link, $query );

if (mysqli_affected_rows ( $link ) == 1) {
   $query = "delete from wap_news_comment where comment_content_id = '{$_GET['id']}'";
    execute ( $link, $query );

	skip('news_list.php','^_^删除成功！');

} else {
	skip('news_list.php','*_*删除失败！');
}
