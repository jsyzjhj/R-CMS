<?php 

/**
* 
*/
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{
	
	public function index(){
		$AdminUser = $_SESSION['AdminUser'];//自己加的
		$this -> assign('user',$AdminUser['username']);//自己加的
		$this -> display();
	}
}


 ?>