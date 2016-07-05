<?php 

namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class CatController extends CommonController{
	
	public function index() {
		$id = intval($_GET['id']);
		$this -> display();
	}
}

 ?>