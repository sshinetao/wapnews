 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
 include_once '../conf/page.inc.php';
 $title = "分类列表";
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
                <th class="table-type ">子分类</th>
                 <th class="table-type am-hide-sm-only">父分类</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>



            <?php
            $query = "select count(*) from wap_news_category";
            $count = num($link, $query);
            $page_size = 10;
            $page = page($count, $page_size);
            $query = "SELECT
a.category_name AS ziname,
b.category_name AS funame,
b.category_id AS fuid,
a.category_id AS ziid,
a.category_porder AS porder
FROM
wap_news_category AS a
left JOIN wap_news_category AS b ON a.category_parent_id = b.category_id
 order by porder desc  {$page['limit']}
     ";

           //var_dump($count);
            $result = execute($link, $query);
            while($data = mysqli_fetch_assoc($result)){
            ?>
             <tr>
              <td><input type="checkbox" /></td>
              <td><?php echo $data['ziid']?></td>
              <td ><?php echo $data['ziname']?></td>
               <td class="am-hide-sm-only"><?php
               if($data['funame']!='') {

                   echo  $data['funame'];
               }else{
                   echo '<b>无</b>';
               }
               ?></td>

              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">

                    <a style="background: #fff" class="am-btn am-btn-default am-btn-xs am-text-secondary" href='<?php
                    if($data['funame']==''){
                        echo 'category_edit.php?id=';
                    }else{
                        echo 'category_son_edit.php?id=';
                    }

                    ?><?php

                    echo $data['ziid']

                    ?>'><span class="am-icon-pencil-square-o"></span> 编辑</a>
                    <a href="javascript:void(0)"  style="background: #fff" onclick="del(<?php echo $data['ziid']?>)" class="am-btn am-btn-default am-btn-xs am-text-danger "><span class="am-icon-trash-o"></span> 删除</a>

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

			var url = "category_del.php?id="+id;

			window.location.href=url;

		}


	}

  </script>
  <!-- content end -->

<?php
include_once 'common/footer.php';?>