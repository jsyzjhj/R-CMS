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

	public function find($id) {
		$conditions['news_id'] = $id;
		$data = $this -> _db -> where($conditions) -> find();
		return $data;
	}

	public function updateById($id,$data) {
		if(!$id || !is_numeric($id)) {
			throw_exception('ID不合法');
		}
		if(!$data || !is_array($data)) {
			throw_exception('更新数据不合法');
		}
		return $this -> _db -> where('news_id = '.$id) -> save($data);
	}


	public function updateStatusById($id,$status) {
		if(!$id || !is_numeric($id)) {
			throw_exception('ID不合法');
		}
		if(!is_numeric($status)) {
			throw_exception('状态不合法');
		}
		$data['status'] = $status;
		return $this -> _db ->where('news_id='.$id) -> save($data);
	}

	public function updateListorderById($id,$listorder) {
		if(!$id || !is_numeric($id)) {
			throw_exception('ID不合法');
		}
		if(!is_numeric($listorder)) {
			throw_exception('序号不合法');
		}
		$data = array('listorder' => intval($listorder));
		return $this -> _db -> where('news_id='.$id) -> save($data);
	}

	public function getNewsByNewsIds($newsids) {
		if(!$newsids || !is_array($newsids)) {
			throw_exception('选择ID出错');
		}
		$conditions = array(
			'news_id' => array('in',implode(',', $newsids))
			);
		return $this -> _db -> where($conditions) -> select();
	}

	public function select($conditions,$limit = 0) {
		if(!$conditions || !is_array($conditions)) {
			throw_exception('查询新闻条件不合法');
		}
		if($limit === 0) {
			return $this -> _db -> where($conditions) -> select();
		}else{
			return $this -> _db -> where($conditions) -> limit($limit) -> select();
		}
	}

	// public function getRank($data = array(),$limit = 100) {
	// 	$list = $this -> _db -> where($data) -> order('count desc,news_id desc') -> limit($limit) -> select();
	// 	return $list;
	// }
}


 ?>