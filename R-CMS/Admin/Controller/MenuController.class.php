<?php 

/**
* 
*/

namespace Admin\Controller;
use Think\Controller;

class MenuController extends Controller{
	public function index() {
		$data = array();
		if(isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0,1))) {
			$data['type'] = intval($_REQUEST['type']);
			$this->assign('type',$data['type']);
		}else {
			$this->assign('type',-1);			
		}
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : '1';
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : '10';
		$menus = D('Menu') -> getMenus($data,$page,$pageSize);
		$menusCount = D('Menu') -> getMenusCount($data);
		//分页
		$res = new \Think\Page($menusCount,$pageSize);
		$pageRes = $res -> show();
		$this -> assign('pageRes',$pageRes);
		$this -> assign('menus',$menus);
		$this -> display();
	}

	public function add(){

		if ($_POST) {
			if (!$_POST['name'] || !isset($_POST['name'])) {
				return show(0,'菜单名不能为空');
			}
			if (!$_POST['m'] || !isset($_POST['m'])) {
				return show(0,'模块名不能为空');
			}
			if (!$_POST['c'] || !isset($_POST['c'])) {
				return show(0,'控制器不能为空');
			}
			if (!$_POST['f'] || !isset($_POST['f'])) {
				return show(0,'方法名不能为空');
			}
			if($_POST['menu_id']){
				$this -> save($_POST);
			}
			$menuId = D('Menu')->insert($_POST);
			if($menuId){
				return show(1,'新增成功');
			}
			return show(0,'新增失败');
		}else{
			$this -> display();
		}
		
	}


	public function edit(){
		$menuId = $_GET['id'];
		$menu = D('Menu') -> find($menuId);
		$this -> assign('menu',$menu);
		$this -> display();
	}

	public function save($data) {
		$menuId = $data['menu_id'];
		unset($data['menu_id']);
		try {
			$id = D('Menu') -> updateMenuById($menuId,$data);
			if($id === false) {
				return show(0,'更新失败');
			}
			return show(1,'更新成功');
		}catch(Exception $e) {
			return show(0,$e->getMessage());
		}
	}

	public function setStatus(){
		try{
		$id = $_POST['id'];
		$status = $_POST['status'];
		$res = D('Menu')->updateStatusById($id,$status);
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

	public function listorder() {
		$listorder = $_POST['listorder'];
		$jump_url = $_SERVER['HTTP_REFERER'];
		$errors = array();
		if($listorder) {
			try{
				foreach ($listorder as $menuId => $value) {
					$id = D('Menu')->updateMenuListorderById($menuId,$value);
					if($id === false) {
						$errors[] = $menuId;
					}
				}
			}catch(Exception $e){
					return show(0,$e->getMessage(),array('jump_url'=>$jump_url));
			}
				if ($errors) {
						return show(0,'排序失败-'.implode(',', $errors),array('jump_url'=>$jump_url));
					}
				return show(1,'排序成功',array('jump_url'=>$jump_url));
		}
		return show(0,'排序数据失败',array('jump_url'=>$jump_url));
	}
}

 ?>