<?php 

/**
* 
*/
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{
	
	public function index(){
		$maxNewsCount = D('News') -> maxNewsCount();
		$newsCount = D('News') -> getNewsCount();
		$positionCount = D('Position') -> getPositionCount();
		$loginCount = D('Admin') -> getLastLoginCount();
		$this -> assign('loginCount',$loginCount);
		$this -> assign('positionCount',$positionCount);
		$this -> assign('newsCount',$newsCount);
		$this -> assign('maxNewsCount',$maxNewsCount);
		$this -> display();
	}
}


 ?>