
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
        <div class="am-form-group">
          <select data-am-selected="{btnSize: 'sm'}">
            <option value="option1">所有类别</option>
            <option value="option2">IT业界</option>
            <option value="option3">数码产品</option>
            <option value="option3">笔记本电脑</option>
            <option value="option3">平板电脑</option>
            <option value="option3">只能手机</option>
            <option value="option3">超极本</option>
          </select>
        </div>
      </div>
      <div class="am-u-sm-12 am-u-md-3">
        <div class="am-input-group am-input-group-sm">
          <input type="text" class="am-form-field">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
          </span>
        </div>
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
                <th class="table-title">标题</th>
                <th class="table-type am-hide-sm-only">子分类</th>
                 <th class="table-type am-hide-sm-only">父分类</th>
                <th class="table-author am-hide-sm-only">作者</th>
                <th class="table-date am-hide-sm-only">发布日期</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>



            <?php
            $query = "select count(*) from wap_news_content";
            $count = num($link, $query);
            $page_size = 10;
            $page = page($count, $page_size);
            $query = "SELECT
a.content_id AS content_id,
a.content_post_time AS post_time,
c.category_name AS category_name,
d.category_name AS category_father_name,
e.manage_name AS author_name,
a.content_author_id AS author_id,
a.content_title
FROM
wap_news_content AS a
INNER JOIN wap_news_category AS c ON a.content_category_id = c.category_id
INNER JOIN wap_news_category AS d ON c.category_parent_id = d.category_id
INNER JOIN wap_news_manage AS e ON a.content_author_id = e.manage_id
GROUP BY
a.content_id,
a.content_title,
a.content_content,
a.content_category_id,
a.content_post_time,
a.content_author_id,
c.category_name,
d.category_name,
e.manage_name order by content_id desc  {$page['limit']}
     ";

           //var_dump($count);
            $result = execute($link, $query);
            while($data = mysqli_fetch_assoc($result)){
            ?>
             <tr>
              <td><input type="checkbox" /></td>
              <td><?php echo $data['content_id']?></td>
              <td><a href="#"><?php echo $data['content_title']?></a></td>
              <td class="am-hide-sm-only"><?php echo $data['category_name']?></td>
               <td class="am-hide-sm-only"><?php echo $data['category_father_name']?></td>
              <td class="am-hide-sm-only"><?php echo $data['author_name']?></td>
               <td class="am-hide-sm-only"><?php echo $data['post_time']?></td>

              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                  <?php

                  if ((isset($_COOKIE['manage']['manage_id'])==$data['author_id'])||(is_admin_login( $link))){
                  ?>
                    <a style="background: #fff" class="am-btn am-btn-default am-btn-xs am-text-secondary" href='news_edit.php?id=<?php echo $data['content_id']?>'><span class="am-icon-pencil-square-o"></span> 编辑</a>
                    <a href="javascript:void(0)"  style="background: #fff" onclick="del(<?php echo $data['content_id']?>)" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</a>
                    <?php
                  }else{
                    ?>

                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary am-disabled"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only am-disabled"><span class="am-icon-trash-o"></span> 删除</button>
                    <?php
                  }
                  ?>
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

			var url = "news_del.php?id="+id;

			window.location.href=url;

		}


	}

  </script>
  <!-- content end -->
