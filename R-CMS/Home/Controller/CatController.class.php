<?php 

namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class CatController extends CommonController{
	
	public function index() {
		$id = intval($_GET['id']);
 		$barMenus = D('Menu') -> getBarMenus();
  		$this -> assign('barMenus',$barMenus);
		$this -> display();
	}
}

 ?>