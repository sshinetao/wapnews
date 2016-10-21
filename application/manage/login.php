<?php
include_once '../conf/mysql.inc.php';
include_once '../conf/tool.inc.php';
/* var_dump($_COOKIE['user']['user_login_name']);
var_dump($_COOKIE['user']['user_password']); */
$link = connect ();
$manage_id = is_manage_login($link);
if ($manage_id ) {
	skip ( 'news_add.php', '*_* 不要重复登陆！' );
}
if (isset($_POST['login'])) {
        var_dump($_POST);
    include_once 'conf/login_check.inc.php';
    escape($link, $_POST);
    $query = "
	    select * from wap_news_manage where
	manage_login_name = '{$_POST['manage_login_name']}'
	and manage_password = md5('{$_POST['manage_password']}') ";
    // var_dump($query);exit();
    $result = execute($link, $query);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        setcookie('manage[manage_id]', $data['manage_id']);
        setcookie('manage[manage_name]', $data['manage_name']);
        setcookie('manage[manage_touxiang]', $data['manage_touxiang']);
        setcookie('manage[manage_login_name]', $data['manage_login_name']);
        setcookie('manage[manage_password]', sha1($data['manage_password']));
        $query= "update wap_news_manage set manage_last_time = now() where manage_login_name ='{$data['manage_login_name']}'";
        $result = execute($link, $query);
        skip('news_add.php', '^_^ 登录成功！');
    } else {
        skip('login.php', '*_* 登录失败，用户名或密码错误！');
    }
}

$title = '登录';

?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>Login Page | Amaze UI Example</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="../../public/assets/i/favicon.png">
  <link rel="stylesheet" href="../../public/assets/css/amazeui.min.css"/>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
  <script>
  		function changepic(){
		  var img = document.getElementById("checkpic").src="../common/verify_code.php?id="+Math.random()*10;
 		 return;
				}
</script>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>WAPNEWS</h1>
    <p>自适应设备<br/>新闻网站</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>网站新闻编辑 登录</h3>

    <br>

    <form method="post" class="am-form">
      <label for="email">用户名:</label>
      <input type="text" name="manage_login_name" >
      <br>
      <label for="password">密码:</label>
      <input type="password" name="manage_password" value="">
      <br>
      <label for="password">验证码:</label><br />
       <input type="text" name="verify" value="">

 <br>
     <img onclick="changepic();" id="checkpic" alt="点击刷新"
						src="../common/verify_code.php">

      <br />
      <label for="remember-me">
        <input id="remember-me" type="checkbox">
        记住密码
      </label>
      <br />
      <div class="am-cf">
        <input type="submit" name="login" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
      </div>
    </form>
    <hr>
    <p>@2016</p>
  </div>
</div>
</body>
</html>
