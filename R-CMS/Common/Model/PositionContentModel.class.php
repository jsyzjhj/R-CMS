<?php 

namespace Common\Model;
use Think\Model;

/**
* 
*/
class PositionContentModel extends Model{
	
	private $_db = '';

	function __construct() {
		$this -> _db = M('position_content');
	}

	public function insert($data) {
		if(!$data || !is_array($data)) {
			throw_exception('推荐位内容出错');
		}
		$data['create_time'] = time();
		return $this -> _db -> add($data);
	}

	public function getPositions($data) {
		$conditions = array();
		if($data['title']) {
			$conditions['title'] = array('like','%'.$data['title'].'%');
		}
		// print_r($data);
		$conditions['position_id'] = $data['position_id'];
		return $this -> _db -> where($conditions) -> order('listorder') -> select();

	}

	public function updateListorderById($id,$listorder) {
		if(!is_numeric($listorder)){
			throw_exception('排序序号不合法');
		}
		$data['listorder'] = $listorder;
		return $this -> _db -> where('id='.$id) -> save($data);
	}

	public function getPositionContentById($id) {
		return $this -> _db -> where('id='.$id) -> find();
	}

	public function updateById($id,$data) {
		if(!$id || !is_numeric($id)) {
			throw_exception('ID不合法');
		}
		if(!$data || !is_array($data)) {
			throw_exception('更新数据不合法');
		}
		return $this -> _db -> where('id='.$id) -> save($data);
	}

	public function updateStatusById($id,$status) {
		if(!$id || !is_numeric($id)) {
			throw_exception('ID不合法');
		}
		if(!is_numeric($status)) {
			throw_exception('状态不合法');
		}
		$data['status'] = $status;
		return $this -> _db -> where('id='.$id) -> save($data);
	}

	// public function getPositionContent($conditions) {
	// 	if(!$conditions || !is_array($conditions)) {
	// 		throw_exception('推荐位内容数据不合法');
	// 	}
	// 	return $this -> _db -> where($conditions) -> select();
	// }

	public function select($conditions,$limit = 0) {
		if(!$conditions || !is_array($conditions)) {
			throw_exception('推荐位内容数据不合法');
		}
		if($limit === 0) {
			return $this -> _db -> where($conditions) -> select();
		}else{
			return $this -> _db -> where($conditions) -> limit($limit) -> select();
		}
	}
}

 ?>