

<!-- content start -->
<div class="admin-content">

	<div class="am-cf am-padding">
		<div class="am-fl am-cf">
			<strong class="am-text-primary am-text-lg">表单</strong> / <small>form</small>
		</div>
	</div>

	<?php
	if (isset($_POST['submit'])){
	    $query = "insert into wap_news_content
	    (content_title,content_content,content_post_time,content_category_id,content_author_id)
	    values ('{$_POST['content_title']}','{$_POST['content_content']}',now(),{$_POST['category_id']},{$_COOKIE['manage']['manage_id']}) ";
	    //var_dump($query);
	   execute($link, $query);
	    if (mysqli_affected_rows($link)==1){
	        skip('news_add.php', '添加成功！');
	    }else{
	        skip('news_add.php', '添加失败！');
	        }


	}

	?>
	<div class="am-tabs am-margin" data-am-tabs>
		<ul class="am-tabs-nav am-nav am-nav-tabs">

			<li><a href="#tab2">详细描述</a></li>
		</ul>

		<div class="am-tabs-bd">


			<div class="am-tab-panel am-fade" id="tab2">
				<form class="am-form" method="post">




					<div class="am-g am-margin-top">
						<div class="am-u-sm-4 am-u-md-2 am-text-right">所属类别</div>
						<div class="am-u-sm-8 am-u-md-10">
							<select data-am-selected="{btnSize: 'sm'}" name="category_id">
							<?php

								$query_category_father = "select  category_id,category_name from wap_news_category where category_parent_id = 0  order by category_porder asc";
                               // var_dump($query_category_father);
								$result_category_father = execute($link, $query_category_father);
								while ($data_category_father = mysqli_fetch_assoc($result_category_father)){
								     //echo $data_category_father;
							?>
							<optgroup label="<?php echo $data_category_father['category_name']?>">
										<?php
										$query_category_son = "select category_id,category_name from wap_news_category where category_parent_id = {$data_category_father['category_id']}  order by category_porder asc";
										$result_category_son = execute($link, $query_category_son);
										while ($data_category_son = mysqli_fetch_assoc($result_category_son)){
										?>
									<option value="<?php echo $data_category_son['category_id'] ?>"><?php echo '  ----'.$data_category_son['category_name'] ?></option>
										<?php
										}
										?>
								</optgroup>
							<?php
								}
							?>

							</select>
						</div>
					</div>

					<div class="am-g am-margin-top">
						<div class="am-u-sm-4 am-u-md-2 am-text-right">文章标题</div>
						<div class="am-u-sm-8 am-u-md-4">
							<input type="text" class="am-input-sm" name="content_title">
						</div>
						<div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
					</div>

					<!-- <div class="am-g am-margin-top">
						<div class="am-u-sm-4 am-u-md-2 am-text-right">文章作者</div>
						<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
							<input type="text" class="am-input-sm">
						</div>
					</div>

					<div class="am-g am-margin-top">
						<div class="am-u-sm-4 am-u-md-2 am-text-right">信息来源</div>
						<div class="am-u-sm-8 am-u-md-4">
							<input type="text" class="am-input-sm">
						</div>
						<div class="am-hide-sm-only am-u-md-6">选填</div>
					</div>

					<div class="am-g am-margin-top">
						<div class="am-u-sm-4 am-u-md-2 am-text-right">内容摘要</div>
						<div class="am-u-sm-8 am-u-md-4">
							<input type="text" class="am-input-sm">
						</div>
						<div class="am-u-sm-12 am-u-md-6">不填写则自动截取内容前255字符</div>
					</div> -->

					<div class="am-g am-margin-top-sm">
						<div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
							内容描述</div>
						<div class="am-u-sm-12 am-u-md-10">
							<textarea id="container" name="content_content" rows="10" placeholder="请使用富文本编辑插件"></textarea>
						</div>
					</div>


			</div>

		</div>
	</div>

	<div class="am-margin">
		<button type="submit" name="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
		<button type="reset" class="am-btn am-btn-primary am-btn-xs">放弃保存</button>
	</div>
</div>
<!-- content end -->
</form>

<!-- 配置文件 -->
<script type="text/javascript"
	src="../../public/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="../../public/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
        var editor = UE.getEditor('container');
    </script>

