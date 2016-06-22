<?php 

namespace Common\Model;
use Think\Model;

/**
* 
*/
class NewsModel extends Model{
	private $_db = '';
	function __construct()
	{
		$this -> _db = M('news');
	}

	public function insert($data){
		if(!$data || !is_array($data)) {
			return 0;
		}
		$data['create_time'] = time();
		$data['username'] = getLoginUsername();
		return $this -> _db -> add($data);
	}

	public function getNews($data,$page,$pageSize = 10) {
		$conditions = $data;
		if($data['title'] && isset($data['title'])){
			$conditions['title'] = array('like','%'.$data['title'].'%');
		}
		if($data['catid'] && isset($data['catid'])) {
			$conditions['catid'] = intval($data['catid']);
		}
		$offset = ($page -1) * $pageSize;
		$list = $this -> _db -> where($conditions) -> order('listorder,news_id') -> limit($offset,$pageSize) -> select();
		return $list;
	}

	public function getNewsCount($data=array()){
		$conditions = $data;
		if($data['title'] && isset($data['title'])){
			$conditions['title'] = array('like','%'.$data['title'].'%');
		}
		if($data['catid'] && isset($data['catid'])) {
			$conditions['catid'] = intval($data['catid']);
		}
		return $this -> _db -> where($conditions) -> count();
	}
}


 ?>