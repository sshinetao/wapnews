 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
 include_once '../conf/page.inc.php';
$title = "新闻编辑";
include_once 'common/header.php';
$link = connect();
if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
    skip ( 'user_list.php', '*_*id不存在,删除失败！' );
}
include_once '../manage/news_edit.inc.php';
include_once 'common/footer.php';
?>

