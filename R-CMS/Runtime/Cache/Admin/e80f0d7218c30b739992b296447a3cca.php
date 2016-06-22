<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>R内容管理平台</title>
	<link rel="stylesheet" type="text/css" href="/R-CMS/Public/css/bootstrap.min.css">
</head>
<body>
<style>
	.s_center{
		margin-left: auto;
		margin-right: auto;
	}
</style>
<div class="s_center container clo-lg-6">
	<form class="form-signin" enctype="multipart/form-data" method="post">
		<h2 class="form-signin-heading">请登录</h2>
		<label class="sr-only">用户名</label>
		<input type="text" name="username" class="form-control" placeholder="请填写用户名" required autofocus>
		<br />
		<label class="sr-only">密码</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
		<br />
		<button class="btn btn-lg btn-primary btn-block" type="button" onclick="login.check()">登录</button>
	</form>
</div>
<script src="/R-CMS/Public/js/jquery.js"></script>
<script src="/R-CMS/Public/js/dialog/layer.js"></script>
<script src="/R-CMS/Public/js/dialog.js"></script>
<script src="/R-CMS/Public/js/admin/login.js"></script>
</body>
</html>