<?php
include_once '../conf/mysql.inc.php';
include_once '../conf/tool.inc.php';
$title = "个人资料";
include_once 'common/header.php';
$link = connect();
?>
<!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
    </div>

    <hr/>

    <div class="am-g">



    <?php
    if (isset($_POST['saveName'])){
        $query = "update wap_news_manage set manage_name = '{$_POST['manage_name']}' where manage_id = {$_GET['id']}";
         execute($link, $query);
         if (mysqli_affected_rows($link)==1){

             skip("info.php?id={$_GET['id']}", '用户名修改成功！重新登录查看！');
         }else{
             skip("info.php?id={$_GET['id']}", '用户名修改失败！');
         }

    }

    if (isset($_POST['savePassword'])){
        $query = "update wap_news_manage set manage_password = md5('{$_POST['manage_password']}') where manage_id = {$_GET['id']}";
        var_dump($query);
        execute($link, $query);
        if (mysqli_affected_rows($link)==1){

            skip("info.php?id={$_GET['id']}", '密码修改成功！重新登录！');
        }else{
            skip("info.php?id={$_GET['id']}", '用户名修改失败！');
        }

    }


    ?>

      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">




      </div>

      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <div class="am-form am-form-horizontal" >
			<form action="" method="post">
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="姓名 / Name" name="manage_name">
              <small>输入你的名字。</small>
            </div>
          </div>
			<div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" name="saveName" class="am-btn am-btn-primary">保存修改</button>
            </div>
          </div>
			</form>
			<form action="" method="post">
          <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">密码 / Password</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-weibo" placeholder="输入你的密码 / Password" name="manage_password">
               <small>输入你的密码。</small>
            </div>
          </div>

          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" name="savePassword" class="am-btn am-btn-primary">保存修改</button>
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
