<?php 

namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class CommonController extends Controller{
	
	function __construct() {
		header("Content-type:text/html;charset=utf-8");
		parent::__construct();
	}

	public function error($message = '') {
		$message = $message?$message:'系统发生错误';
		$this -> assign('message',$message);
		$this -> display('Index/error');
	}

	public function getRank($data = array(),$limit = 100) {
		return M('News') -> where($data) ->  order('count desc,news_id desc') -> limit($limit) -> select();
	}
}

 ?>