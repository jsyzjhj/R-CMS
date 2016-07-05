<?php 

namespace Common\Model;
use Think\Model;

/**
* 
*/
class PositionModel extends Model{

	private $_db='';
	
	function __construct(){
		$this -> _db = M('position');
	}

	public function getNormalPosition() {
		$conditions = array('status'=>1);
		$list = $this -> _db -> where($conditions) -> order('id') -> select();
		return $list;
	}

	public function getPositionById($id) {
		return $this -> _db -> where('id='.$id) -> find();
	}

	public function updatePosition($data) {
		$id = $data['positionId'];
		unset($data['positionId']);
		return $this -> _db -> where('id='.$id) -> save($data);
	}

	public function insert($data) {
		$data['create_time'] = time();
		return $this -> _db -> add($data);
	}

	public function updateStatusById($id,$status) {
		if(!$id || !is_numeric($id)){
			throw_exception('ID不合法');
		}
		if(!$status || !is_numeric($status)){
			throw_exception('状态不合法');
		}
		$data['status'] = $status;
		return $this->_db->where('id='.$id)->save($data);
	}

}

 ?>