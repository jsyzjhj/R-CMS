<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>R-CMS后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/R-CMS/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/R-CMS/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/R-CMS/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/R-CMS/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/R-CMS/Public/css/R/common.css" />
    <link rel="stylesheet" href="/R-CMS/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/R-CMS/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/R-CMS/Public/js/jquery.js"></script>
    <script src="/R-CMS/Public/js/bootstrap.min.js"></script>
    <script src="/R-CMS/Public/js/dialog/layer.js"></script>
    <script src="/R-CMS/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/R-CMS/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <?php
 $navs = D('Menu')->getAdminMenus(); $index = 'index'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >R-CMS内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ($user); ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/R-CMS/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/R-CMS/admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($nav["c"])); ?>>
        <a href="<?php echo (getAdminMenuUrl($nav)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($nav["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>

    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/R-CMS/admin.php?c=position">推荐位管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> 编辑
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">

                <form class="form-horizontal" id="rcms-form">
                    <div class="form-group">
                        <label for="inputname" class="col-sm-2 control-label">推荐位名:</label>
                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="inputname" placeholder="请填写推荐位名" value="<?php echo ($position["name"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">状态:</label>
                        <div class="col-sm-5">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" checked> 开启
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0"> 关闭
                        </div>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="positionId" value="<?php echo ($position["id"]); ?>">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default" id="rcms-button-submit">更新</button>
                        </div>
                    </div>
                </form>


            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>

    var SCOPE = {
        'save_url' : '/R-CMS/admin.php?c=position&a=add',
        'jump_url' : '/R-CMS/admin.php?c=position',
    }
</script>
<script src="/R-CMS/Public/js/admin/common.js"></script>



</body>

</html>