<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class PositioncontentController extends Controller{

	public function index() {
		$positions = D('Position') -> getNormalPosition();
		$conditions = array(
			'position_id' => ($_GET['position_id']?$_GET['position_id']:$positions[0]['id'])
			);
		// print_r($conditions);exit;
		if($_GET['title']){
			$conditions['title'] = $_GET['title'];
		}
		$positionContents = D('PositionContent') -> getPositions($conditions);
		$this -> assign('positionContents',$positionContents);
		$this -> assign('positions',$positions);
		$this -> display();
	}

	public function listorder() {
		if(!$_POST || !is_array($_POST)) {
			return show(0,'数据为空');
		}
		$error = array();
		$listorder = $_POST['listorder'];
		$jump_url = $_SERVER['HTTP_REFERER'];
		try{
			foreach ($listorder as $id => $value) {
				$res = D('PositionContent') -> updateListorderById($id,$value);
				if($res === false) {
					$error[] = $id;
				}
			}
		}catch(Exception $e) {
				return show(0,$e->getMessage(),array('jump_url'=>$jump_url));
			}
			if($error) {
				return show(0,'排序失败-'.implode(',', $error),array('jump_url'=>$jump_url));
			}
			return show(1,'排序成功',array('jump_url'=>$jump_url));
	}

	public function add() {
		if($_POST) {
			if(!$_POST['title'] || !isset($_POST['title'])) {
				return show(0,'标题不能为空');
			}
			if(!$_POST['position_id'] || !is_numeric($_POST['position_id'])) {
				return show(0,'ID不合法');
			}
			// if(!$_POST['url'] || !isset($_POST['url'])) {
			// 	return show(0,'url不能为空');
			// }
			if(!$_POST['thumb'] || !isset($_POST['thumb'])) {
				if($_POST['news_id']) {
					$thumb = D('News') -> find($_POST['news_id']);
					$_POST['thumb'] = $thumb;
				}else{
					return show(0,'请上传图片或填写文章id');
				}
			}
			if($_POST['id'] && isset($_POST['id'])) {
				$this -> save($_POST);
			}
			try{
				$id = D('PositionContent') -> insert($_POST);
				if($id) {
					return show(1,'新增成功');
				}
				return show(0,'新增失败');
			}catch(Exception $e) {
				return show(0,$e->getMessage());
			}
		}else{
			$positions = D('Position') -> getNormalPosition();
			$this -> assign('positions',$positions);
			$this -> display();			
		}

	}

	public function edit() {
		if(!$_GET['id']) {
			return show(0,'ID不存在');
		}
		$id = $_GET['id'];
		$res = D('PositionContent') -> getPositionContentById($id);
		// print_r($res);exit;
		$positions = D('Position') -> getNormalPosition();
		$this -> assign('contents',$res);
		$this -> assign('positions',$positions);
		$this -> display();
	}

	public function save($data) {
		$id = $data['id'];
		unset($data['id']);
		try{
			$res = D('PositionContent') -> updateById($id,$data);
			if($res === false) {
				return show(0,'更新失败');
			}
			return show(1,'更新成功');
		}catch(Exception $e) {
			return show(0,$e->getMessage());
		}
	}

	public function setStatus(){
		try{
			if($_POST) {
				$id = $_POST['id'];
				$status = $_POST['status'];
				if(!$id) {
					return show(0,'ID不合法1');
				}
				$res = D('PositionContent') -> updateStatusById($id,$status);
				if($res) {
					return show(1,'操作成功！');
				}else{
					return show(0,'操作失败！');
				}
			}
			return show(0,'没有提交数据');
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
	}

}

 ?>