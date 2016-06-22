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
		$ret = $this->_db->where('username="'.$username.'"')->find();
		return $ret;
	}
}

 ?>