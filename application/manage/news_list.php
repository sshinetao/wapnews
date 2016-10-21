 <?php
 include_once '../conf/mysql.inc.php';
 include_once '../conf/tool.inc.php';
 include_once '../conf/page.inc.php';
 $title = "新闻列表";
 include_once 'common/header.php';
 $link = connect();
 include_once 'news_list.inc.php';
include_once 'common/footer.php';?>