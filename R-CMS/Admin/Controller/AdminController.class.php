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
}


 ?>