<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class PositionController extends Controller{
	public function index() {
		$positions = D('Position') -> getNormalPosition();
		$this -> assign('positions',$positions);
		$this -> display();
	}

	public function edit() {
		if(!$_GET['id'] || !is_numeric($_GET['id'])) {
			return show(0,'ID不合法');
		}
		$id = $_GET['id'];
		$position = D('Position') -> getPositionById($id);
		$this -> assign('position',$position);
		$this -> display();
	}

	public function add() {
		if($_POST['positionId']) {
			if(!$_POST['name']) {
				return show(0,'请填写推荐位名');
			}
			$data = $_POST;
			$res = D('Position') -> updatePosition($data);
			if($res === false) {
				return show(0,'更新失败');
			}
			return show(1,'更新成功');
		}
		$this -> display();
	}

	public function insert() {
		if(!$_POST['name']) {
			return show(0,'请填写推荐位名');
		}
		$data = $_POST;
		$res = D('Position') -> insert($data);	
		if($res === false) {
			return show(0,'添加失败');
		}
		return show(1,'添加成功');
	}


	public function setStatus(){
		try{
		$id = $_POST['id'];
		$status = $_POST['status'];
		$res = D('Position')->updateStatusById($id,$status);
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