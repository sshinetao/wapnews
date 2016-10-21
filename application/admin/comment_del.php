 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';

$link = connect ();
if (!is_admin_login($link)){
    skip('index.php', '没有权限！');
}

if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
	skip ( 'comment_list.php', '*_*id不存在,删除失败！' );
}

$query = "delete from wap_news_comment where comment_id = '{$_GET['id']}'";
    execute ( $link, $query );

if (mysqli_affected_rows ( $link ) == 1) {


	skip('comment_list.php','^_^删除成功！');

} else {
	skip('comment_list.php','*_*删除失败！');
}
