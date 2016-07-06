<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class LoginController extends Controller{
	
	public function index()
	{
		# code...
		if(session('AdminUser')){
			$this->redirect('/R-CMS/admin.php?m=admin&c=index');
		}
		$this ->display();
	}
	public function check(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(!trim($username)){
			return show(0,'用户名不能为空');
		}
		if(!trim($password)){
			return show(0,'密码不能为空');
		}


		$ret = D('Admin')->getAdminByUsername($username);
		if(!($ret)){
			return show(0,'该用户不存在');
		}
		if($ret['password'] != getMd5Password($password))
			return show(0,'密码错误');

		session('AdminUser',$ret);
		$res = D('Admin') -> updateLastLoginTimeByUsername($username);
		if($res) {
			return show(1,'登录成功');
		}
	}

	function loginout(){
		session('AdminUser',null);
		return $this->redirect('/R-CMS/admin.php?m=admin&c=login&a=index');
	}
}

 ?>