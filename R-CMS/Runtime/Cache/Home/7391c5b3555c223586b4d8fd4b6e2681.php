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
        <li><a href="/" class="curr">首页</a></li>
        <?php if(is_array($barMenus)): foreach($barMenus as $key=>$barMenu): ?><li><a href="/R-CMS/index.php?c=cat&id=<?php echo ($barMenu["menu_id"]); ?>"><?php echo ($barMenu["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-9">
<!--         <div class="banner">
          <div class="banner-left">
            <a href="/R-CMS/index.php?c=detail&id=<?php echo ($result['bigPositions']['news_id']); ?>">
            <img width="670" height="360" src="<?php echo ($result['bigPositions']['thumb']); ?>" alt="<?php echo ($result['bigPositions']['title']); ?>">
            </a>
          </div>
          <div class="banner-right">
            <ul>
              <?php if(is_array($result['smallPositions'])): $i = 0; $__LIST__ = $result['smallPositions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
              <a href="/R-CMS/index.php?c=detial&id=<?php echo ($vo["news_id"]); ?>">
                <img width="150" height="113" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>">
                </a>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div> -->
        <div class="news-list">
        <?php if(is_array($result['news'])): $i = 0; $__LIST__ = $result['news'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
            <a href="/R-CMS/index.php?c=detial&id=<?php echo ($vo["news_id"]); ?>"><dt><?php echo ($vo["title"]); ?></dt></a>
            <dd class="news-img">
            <a href="/R-CMS/index.php?c=detial&id=<?php echo ($vo["news_id"]); ?>">
              <img width="200" height="120" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>">
              </a>
            </dd>
            <dd class="news-intro">
              <?php echo ($vo["description"]); ?>
            </dd>
            <dd class="news-info">
              <?php echo ($vo["username"]); ?> <span><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></span> 阅读(0)
            </dd>
          </dl><?php endforeach; endif; else: echo "" ;endif; ?>
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
              <a href="/R-CMS/index.php?c=detial&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["title"]); ?></a>
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