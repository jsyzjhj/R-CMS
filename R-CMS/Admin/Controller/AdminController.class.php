<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class AdminController extends Controller{

	public function index() {
		$admins = D('Admin') -> getAdmins();
		$this -> assign('admins',$admins);
		$this -> display();
	}

	public function add() {
		if($_POST) {
			if(!$_POST['username'] || !isset($_POST['username'])) {
				return show(0,'用户名不能为空');
			}
			if(!$_POST['password'] || !isset($_POST['password'])) {
				return show(0,'密码不能为空');
			}
			$admin = D('Admin') -> getAdminByUsername($_POST['username']);
			if($admin && $admin['status'] != -1) {
				return show(0,'该用户已存在');
			}
			$data = $_POST;
			unset($data['password']);
			// print_r($data);print_r($_POST);exit;
			$data['password'] = getMd5Password($_POST['password']);
			$id = D('Admin') -> insert($data);
			if($id) {
				return show(1,'新增成功');
			}else{
				return show(0,'新增失败');
			}
		}else{
			$this -> display();
		}
	}

	public function setStatus(){
		try{
		$id = $_POST['id'];
		$status = $_POST['status'];
		$res = D('Admin') -> updateStatusById($id,$status);
		if($res){
			return show(1,'操作成功');
		}else{
			return show(0,'操作失败');
		}
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
		return show(0,'没有数据');
	}
}


 ?>