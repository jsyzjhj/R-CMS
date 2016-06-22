<?php 

function show($status,$message,$data=array()){
	$result = array(
		'status' => $status,
		'message' => $message,
		'data' => $data
		);
	exit(json_encode($result));
}

function getMd5Password($password){
	return md5($password.C('MD5_PRE'));
}

function getMenuType($type) {
	if($type == 1){
		return '后台菜单';
	}
	return '前端导航';
}

function getMenuStatus($status) {
	if($status == 0){
		return '关闭';
	}
	if($status == 1){
		return '正常';
	}
	return '删除';
}

function getAdminMenuUrl($nav){
	$url = '/R-CMS/admin.php?c='.$nav['c'].'&a='.$nav['f'];
	if($nav['f'] == 'index'){
	$url = '/R-CMS/admin.php?c='.$nav['c'];		
	}
	return $url;
}

function getActive($navc){
	$c = strtolower(CONTROLLER_NAME);
	if(strtolower($navc) == $c) {
		return 'class="active"';
	}
	return '';
}

function showKind($status,$data) {
	header('Content-type:application/json;charset=UTF-8');
	if($status == 1){
		exit(json_encode(array('error'=>1,'message'=>$data)));
	}
	exit(json_encode(array('error'=>0,'url'=>$data)));
}

function getLoginUsername(){
	if($_SESSION['AdminUser']['username']){
		return $_SESSION['AdminUser']['username'];
	}
	return '';
}

 ?>