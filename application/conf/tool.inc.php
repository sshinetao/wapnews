<?php
function skip($url, $message) {
	$html = <<<A
		<!doctype html>
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" show="IE=edge,chrome=1" />
		<title>正在跳转... {$message}</title>
		<link rel="stylesheet" href="../public/assets/css/amazeui.min.css">
<link rel="stylesheet" href="../public/assets/css/app.css">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta http-equiv="Refresh" content="3; url={$url}" />
		</head>
		<body>
		<article data-am-widget="paragraph"
	class="am-paragraph am-paragraph-default"
	data-am-paragraph="{ tableScrollable: true, pureview: true }">
		<section class="am-panel am-panel-default">
  <header class="am-panel-hd">
    <h3 class="am-panel-title">信息提示</h3>
  </header>
  <div class="am-panel-bd">
    {$message}，<a href="{$url}" class="btn">3秒后自动跳转</a>
  </div>
</section>
		</article>



		</body>
		</html>
A;
	echo $html;
	exit ();
}

// 检验普通用户
function is_user_login($link)
{
    if (isset($_COOKIE['user']['user_login_name']) || isset($_COOKIE['user']['user_password'])) {
        {
            $query = "select * from wap_user where
	        user_login_name = '{$_COOKIE['user']['user_login_name']}' and sha1(user_password) = '{$_COOKIE['user']['user_password']}'";
            //var_dump($query);exit();
            $result = execute($link, $query);

            if (mysqli_num_rows($result) == 1) {

                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}


// 网站编辑
function is_manage_login($link)
{
    if (isset($_COOKIE['manage']['manage_login_name']) || isset($_COOKIE['manage']['manage_password'])) {
        {
            $query = "select * from wap_news_manage where
            manage_login_name = '{$_COOKIE['manage']['manage_login_name']}' and sha1(manage_password) = '{$_COOKIE['manage']['manage_password']}'";
            //var_dump($query);exit();
            $result = execute($link, $query);

            if (mysqli_num_rows($result) == 1) {

                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}



