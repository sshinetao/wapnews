 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
 include_once '../conf/page.inc.php';
 $title = "分类名修改";
 include_once 'common/header.php';
 $link = connect();
?>


    <?php
    if (isset($_POST['add'])){
        $query = "insert into wap_news_category (category_name,category_parent_id,category_porder)
        values('{$_POST['category_name']}',{$_POST['category_parent_id']},{$_POST['category_porder']}) ";
         execute($link, $query);
         if (mysqli_affected_rows($link)==1){

             skip("category_list.php?", '分类添加成功！');
         }else{
             skip("category_list.php", '分类添加失败！');
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
						<label for="user-name" class="am-u-sm-3 am-form-label">父分类</label>
						<div class="am-u-sm-9">
							<select data-am-selected="{btnSize: 'sm'}" name="category_parent_id">
							<?php
							$query = "select * from wap_news_category where category_parent_id = 0";
							$result = execute($link, $query);
							while ($data = mysqli_fetch_assoc($result)){
							?>
            						  <option value="<?php  echo $data['category_id']?>"><?php  echo $data['category_name']?></option>
							<?php } ?>
          				  </select>
						</div>
					</div>


					<div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">子分类名称</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="子分类名称" name="category_name">

            </div>
          </div>
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">排序</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="排序" name="category_porder">

            </div>
          </div>
			<div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" name="add" class="am-btn am-btn-primary">添加</button>
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