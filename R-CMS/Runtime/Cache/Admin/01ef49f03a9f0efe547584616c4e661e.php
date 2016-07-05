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
    
    <a class="navbar-brand" href="/R-CMS/admin.php">R-CMS内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ($user); ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/R-CMS/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
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

        <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/R-CMS/admin.php?c=position">推荐位管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table">推荐位列表</i>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div>
          <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3></h3>
                <div class="table-responsive">
                    <form id="rcms-listorder">
                    <table class="table table-bordered table-hover rcms-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>推荐位名称</th>
                            <th>时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($positions)): $i = 0; $__LIST__ = $positions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$position): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($position["id"]); ?></td>
                                <td><?php echo ($position["name"]); ?></td>
                                <td><?php echo (date("Y-m-d H:i",$position["create_time"])); ?></td>
                                <td><?php echo (getMenuStatus($position["status"])); ?></td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true" id="rcms-edit" attr-id="<?php echo ($position["id"]); ?>"></span>    <a href="javascript:void(0)" attr-id="<?php echo ($position["id"]); ?>" id="rcms-delete"  attr-a="position" attr-message="删除"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    </form>
                </div>
                    <nav>
                        <ul class="pagination">
                            <?php echo ($pageRes); ?>
                        </ul>
                    </nav>
                    <div>
                        <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>更新排序 </button>
                    </div>                    
            </div>
        </div>

        <!-- </div> -->
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
        'add_url' : '/R-CMS/admin.php?c=position&a=add',
        'edit_url' : '/R-CMS/admin.php?c=position&a=edit',
        'set_status_url' : '/R-CMS/admin.php?c=position&a=setStatus',
    }
</script>
<script src="/R-CMS/Public/js/admin/common.js"></script>



</body>

</html>