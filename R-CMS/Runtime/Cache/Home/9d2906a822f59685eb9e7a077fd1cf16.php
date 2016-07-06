<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
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
        <li><a href="/R-CMS/index.php" <?php if($_GET['id'] == 0): ?>class="curr"<?php else: ?>class=""<?php endif; ?>>首页</a></li>
        <?php if(is_array($barMenus)): foreach($barMenus as $key=>$barMenu): ?><li><a href="/R-CMS/index.php?c=cat&id=<?php echo ($barMenu["menu_id"]); ?>" <?php if($result['news']['catid'] == $barMenu['menu_id']): ?>class="curr"<?php else: ?>class=""<?php endif; ?>><?php echo ($barMenu["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-9">
        <div class="news-detail">
          <h1 style="text-align:center"><?php echo ($result["title"]); ?></h1>        
          <?php echo ($result["newsContent"]); ?>
        </div>
      </div>
            <div class="col-sm-3 col-md-3">
        <div class="right-title">
          <h3>文章排行</h3>
          <span>TOP ARTICLES</span>
        </div>
        <div class="right-content">
          <ul>
            <?php if(is_array($result['rankNews'])): $k = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
              <a href="/R-CMS/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["title"]); ?></a>
              <?php if($k == 1): ?><div class="intro">
                <?php echo ($vo["description"]); ?>
              </div><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
        
        <div class="right-hot">
        <?php if(is_array($result['advNews'])): $k = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        
      </div>
    </div>
  </div>
</section>
</body>
</html>