 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';

$link = connect ();
if (!is_admin_login($link)){
    skip('index.php', '没有权限！');
}

if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
	skip ( 'news_list.php', '*_*id不存在,删除失败！' );
}
$query = "select count(*) from wap_news_category where category_parent_id = {$_GET['id']}";
$count = num($link, $query);
if ($count!=0){
    skip('category_list.php', '此版块下面有子版块，请删除子版块后再进行次操作！');
}


$query = "delete from wap_news_category where category_id = '{$_GET['id']}'";
execute ( $link, $query );

if (mysqli_affected_rows ( $link ) == 1) {
    $query = "delete from wap_news_content where content_category_id = '{$_GET['id']}'";
    execute ( $link, $query );
   $query = "delete from wap_news_comment where comment_content_id = '{$_GET['id']}'";
    execute ( $link, $query );

	skip('category_list.php','^_^删除成功！');

} else {
	skip('category_list.php','*_*删除失败！');
}
