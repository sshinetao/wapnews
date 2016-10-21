 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
 include_once '../conf/page.inc.php';
 $title = "评论列表";
 include_once 'common/header.php';
 $link = connect();
?>

 <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">表格</strong> / <small>Table</small></div>
    </div>

    <div class="am-g">
<!--       <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
          </div>
        </div>
      </div> -->
      <div class="am-u-sm-12 am-u-md-3">

      </div>

    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th>
                <th class="table-id">ID</th>
                <th class="table-type ">评论内容</th>
                <th class="table-type ">评论人</th>
                 <th class="table-type ">评论时间</th>
                 <th class="table-type am-hide-sm-only">所属新闻</th>
                  <th class="table-type am-hide-sm-only">所属分类</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>



            <?php
            $query = "select count(*) from wap_news_comment";
            $count = num($link, $query);
            $page_size = 10;
            $page = page($count, $page_size);
            $query = "SELECT
a.comment_user_id AS comment_user_id,
a.comment_id AS comment_id,
a.comment_time AS comment_time,
b.content_title AS news_title,
c.category_name AS category_name,
a.comment_content AS `comment`,
d.user_name AS user_name
FROM
wap_news_comment AS a
INNER JOIN wap_news_content AS b ON a.comment_content_id = b.content_id
INNER JOIN wap_news_category AS c ON b.content_category_id = c.category_id
INNER JOIN wap_user AS d ON a.comment_user_id = d.user_id
 order by a.comment_id desc  {$page['limit']}
     ";

           //var_dump($count);
            $result = execute($link, $query);
            while($data = mysqli_fetch_assoc($result)){
            ?>
             <tr>
              <td><input type="checkbox" /></td>
              <td><?php echo $data['comment_id']?></td>
              <td ><?php echo $data['comment']?></td>
			  <td><?php echo $data['user_name']?></td>
              <td ><?php echo $data['comment_time']?></td>
              <td><?php echo $data['news_title']?></td>
              <td ><?php echo $data['category_name']?></td>

              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">


                    <a href="javascript:void(0)"  style="background: #fff" onclick="del(<?php echo $data['comment_id']?>)" class="am-btn am-btn-default am-btn-xs am-text-danger "><span class="am-icon-trash-o"></span> 删除</a>

                  </div>
                </div>
              </td>
                </tr>
            <?php
            }
            ?>


          </tbody>
        </table>
          <div class="am-cf">
  共 <?php echo $count?> 条记录
  <div class="am-fr">
    <ul class="am-pagination">
     <?php
echo $page['html'];
?>
    </ul>
  </div>
</div>
          <hr />
          <p>注：.....</p>
        </form>
      </div>

    </div>
  </div>
  <script>
  function del(id)
	{


		if(confirm("确定要删除第"+id+"条记录吗？"))
		{

			var url = "comment_del.php?id="+id;

			window.location.href=url;

		}


	}

  </script>
  <!-- content end -->

<?php
include_once 'common/footer.php';?>