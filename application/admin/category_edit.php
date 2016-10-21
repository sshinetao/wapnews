 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
 include_once '../conf/page.inc.php';
 $title = "分类名修改";
 include_once 'common/header.php';
 $link = connect();
 if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
     skip ( 'user_list.php', '*_*id不存在,删除失败！' );
 }
?>


 <?php
    if (isset($_POST['save'])){
        $query = "update wap_news_category set category_name = '{$_POST['category_name']}',category_porder = {$_POST['category_porder']} where category_id = {$_GET['id']}";
         execute($link, $query);
         if (mysqli_affected_rows($link)==1){

             skip("category_list.php?", '分类名名修改成功！');
         }else{
             skip("category_list.php", '分类名修改失败！');
         }

    }

    ?>
<!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加分类</strong> / <small>add category </small></div>
    </div>

    <hr/>

    <div class="am-g">





      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">




      </div>

      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <div class="am-form am-form-horizontal" >
			<form action="" method="post">
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">父分类名称</label>
            <div class="am-u-sm-9">
            <?php
            $query = "select category_name, category_porder from wap_news_category where category_id = {$_GET['id']}";
            $result = execute($link, $query);
            $data = mysqli_fetch_assoc($result);
            ?>
              <input type="text" id="user-name" placeholder="父分类名称" name="category_name" value="<?php echo $data['category_name']?>">

            </div>
          </div>
                <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">排序</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="排序" name="category_porder" value="<?php echo $data['category_porder']?>">

            </div>
          </div>

			<div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" name="save" class="am-btn am-btn-primary">修改</button>
            </div>
          </div>
			</form>


        </div>
      </div>
    </div>
  </div>
  <!-- content end -->
  <?php
include_once 'common/footer.php';
?>