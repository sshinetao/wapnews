 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
$title = "编辑用户";
include_once 'common/header.php';
$link = connect();
if (! isset ( $_GET ['id'] ) || ! is_numeric ( $_GET ['id'] )) {
    skip ( 'user_list.php', '*_*id不存在,删除失败！' );
}
?>
<!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
    </div>

    <hr/>

    <div class="am-g">



    <?php
    if (isset($_POST['edit'])){
        if($_POST['user_password']==''){
                $sql = <<<A
update wap_user set user_name = '{$_POST['user_name']}' where user_id = {$_GET['id']}
A;
        }else{
                    $sql = <<<A
                    update wap_user set user_name = '{$_POST['user_name']}',user_password = md5('{$_POST['user_password']}') where user_id = {$_GET['id']}
A;
                }
        $query = "{$sql}";
       // var_dump($query);
         execute($link, $query);
         if (mysqli_affected_rows($link)==1){

             skip("user_edit.php?id={$_GET['id']}", '修改成功！');
         }else{
             skip("user_edit.php?id={$_GET['id']}", '修改失败！');
         }

    }


    ?>

      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">




      </div>

      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <div class="am-form am-form-horizontal" >

        <?php

        $query = "select * from wap_user where user_id = {$_GET['id']}";
        $result  = execute($link, $query);
        $data = mysqli_fetch_assoc($result);
        ?>
			<form action="" method="post">


						<div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">登录名 / Name</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="登录名称" name="user_login_name" readonly value="<?php echo $data['user_login_name']?>">
              <small>输入你的名字。</small>
            </div>
          </div>
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="姓名 / Name" name="user_name" value="<?php echo $data['user_name']?>">
              <small>输入你的名字。</small>
            </div>
          </div>


          <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">密码 / Password</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-weibo" placeholder="输入密码 / Password" name="user_password">
               <small>输入你的密码。</small>
            </div>
          </div>

          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" name="edit" class="am-btn am-btn-primary">修改</button>
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