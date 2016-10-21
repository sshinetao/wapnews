<?php
include_once 'inc/mysql.inc.php';
include_once 'inc/page.inc.php';
$link = connect ();
$title = "发帖";
?>
<?php include_once 'inc/header.inc.php';?>

<?php 
$query = "select mid,mname from wap_module where  wap_module.mid= {$_GET['id']} ";
$result = execute($link, $query);
$data = mysqli_fetch_assoc($result);
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="index.php">首页</a></li>
	<li><a href="cate_list.php?id=<?php  echo $data['mid']?>"><?php  echo $data['mname']?></a></li>
	<li class="am-active">发帖</li>
</ol>


<article class="am-paragraph am-paragraph-default">
<div class="am-g" id="reply">
	<div class="am-u-md-12 am-u-sm-centered">

			
		<hr data-am-widget="divider" style=""
			class="am-divider am-divider-dashed" />
		<form class="am-form">
			<fieldset class="am-form-set">
				<input type="text" placeholder="标题"  value="" id="title">
				<label for="title" id="namediv"></label>
				<textarea rows="5" cols="" name="ccontent" id="ccontent"></textarea>
				<label for="ccontent" id="ccontentdiv"></label>
			</fieldset>
			<button type="submit" id="publish" disabled="disabled" class="am-btn am-btn-primary ">确认发表</button>
		</form>
	</div>
</div>
</article>











<?php  include_once 'inc/footer.inc.php'; ?>