<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  <title><?php echo ($basic["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($basic["keywords"]); ?>">
  <meta name="description" content="<?php echo ($basic["description"]); ?>">
  <link rel="stylesheet" href="/R-CMS/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/R-CMS/Public/css/home/main.css" type="text/css" />
</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="/" class="curr">首页</a></li>
        <?php if(is_array($barMenus)): foreach($barMenus as $key=>$barMenu): ?><li><a href="/R-CMS/index.php?c=detials&id=<?php echo ($barMenu["menu_id"]); ?>"><?php echo ($barMenu["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
	<section>
		<div class="container">
			<h1 style="color:red"><?php echo ($message); ?></h1>
			<h3 id="location">系统将在<span style="color:red">3</span>秒后自动跳转</h3>
		</div>
	</section>
</body>
<script src="/R-CMS/Public/js/jquery.js"></script>
<script>
	var url = '/R-CMS/index.php';
	var time = 3;
	setInterval("refer()",1000);
	function refer() {
		if(time == 0) {
			location.href = url;
		}
		$("#location span").html(time);
		time--;
	}
</script>
</html>