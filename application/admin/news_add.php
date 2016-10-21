 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
$title = "新闻添加";
include_once 'common/header.php';
$link = connect();
include_once 'news_add.inc.php';
include_once 'common/footer.php';
?>