<?php
include_once 'conf/mysql.inc.php';
include_once 'conf/tool.inc.php';
$link = connect();
$title = '注册';
include_once 'common/header.inc.php';?>
<script>
  		function changepic(){
		  var img = document.getElementById("checkpic").src="common/verify_code.php?id="+Math.random()*10;
 		 return;
				}
</script>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li class="am-active">注册</li>
</ol>

<?php
if (isset($_POST['submit'])){
    $query  = "insert wap_user
    (user_name,user_login_name,user_password,user_reg_time)
    values
    ('{$_POST['user_name']}','{$_POST['user_login_name']}',md5('{$_POST['user_password']}'),now())";
    execute($link, $query);
        if (mysqli_affected_rows($link)==1){

            skip('index.php', '^_^注册成功！');

        }else{
            skip('register.php', '*_*注册失败！');
        }

}
?>


<article class="am-paragraph am-paragraph-default">
<div class="am-g">
  <div class="am-u-md-12 am-u-sm-centered">
    <form class="am-form" method="post">
      <fieldset class="am-form-set">
        <input type="text" placeholder="登录名" required="required" name="user_login_name">
          <input type="text" placeholder="取个名字" required="required" name="user_name">
        <input type="password" placeholder="设个密码" required="required" name="user_password">
         <input type="text" placeholder="验证码" required="required" name="verify">
        <img id='checkpic' onclick="changepic();" alt="点击刷新"  src="common/verify_code.php" >
      </fieldset>
      <button type="submit" name="submit" class="am-btn am-btn-primary am-btn-block">注册</button>
        <a href="login.php"  class="am-btn am-btn am-btn-success am-btn-block">去登录</a>
    </form>
  </div>
</div>
</article>

















<?php include_once 'common/footer.inc.php';?>