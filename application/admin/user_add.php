 <?php
 include_once '../conf/mysql.inc.php';
 include_once 'inc/tool.inc.php';
$title = "添加用户";
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
    if (isset($_POST['add'])){
        $query = "update wap_news_manage set manage_name = '{$_POST['manage_name']}' where manage_id = {$_GET['id']}";
         execute($link, $query);
         if (mysqli_affected_rows($link)==1){

             skip("info.php?id={$_GET['id']}", '用户添加成功！');
         }else{
             skip("info.php?id={$_GET['id']}", '用户添加失败！');
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
              <input type="text" id="user-name" placeholder="姓名 / Name" name="user_name">
              <small>输入你的名字。</small>
            </div>
          </div>
			<div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" placeholder="登录名称" name="user_login_name">
              <small>输入你的名字。</small>
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">密码 / Password</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-weibo" placeholder="输入密码 / Password" name="manage_password">
               <small>输入你的密码。</small>
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