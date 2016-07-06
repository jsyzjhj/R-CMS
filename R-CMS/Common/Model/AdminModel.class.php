<?php 

/**
* 
*/

namespace Common\Model;
use Think\Model;

class AdminModel extends Model{
	
	private $_db = '';
	function __construct()	{
		# code...
		$this->_db = M('admin');
	}

	public function getAdminByUsername($username) {
		$conditions = array(
			'username' => $username,
			'status' => array('eq',1)
			);
		$ret = $this->_db->where($conditions)->find();
		return $ret;
	}

	public function getAdmins() {
		$data = array(
			'status' => array('neq',-1)
			);
		return $this -> _db ->where($data) -> select();
	}

	public function insert($data) {
		return $this -> _db -> add($data);
	}

	public function updateStatusById($id,$status) {
		if(!$id || !is_numeric($id)){
			throw_exception('ID不合法');
		}
		if(!is_numeric($status)){
			throw_exception('状态不合法');
		}
		$data['status'] = $status;
		return $this->_db->where('admin_id='.$id)->save($data);
	}

	public function updateLastLoginTimeByUsername($username) {
		$conditions = array(
			'username' => $username
			);
		$data['lastlogintime'] = time();
		return $this -> _db -> where($conditions) -> save($data);
	}

	public function getLastLoginCount() {
		$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$conditions = array(
			'status' => 1,
			'lastlogintime' => array('gt',$time)
			);
		return $this -> _db -> where($conditions) -> count();
	}
}

 ?>