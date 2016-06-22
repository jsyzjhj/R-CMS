<?php 

namespace Common\Model;
use Think\Model;

/**
* 
*/
class NewsContentModel extends Model{
	private $_db = '';
	function __construct(){
		$this -> _db = M('news_content');
	}

	public function insert($data) {
		if(!$data || !is_array($data)) {
			return 0;
		}
		$data['create_time'] = time();
		if($data['content'] || isset($data['content'])){
			$data['content'] = htmlspecialchars($data['content']);
		}
		return $this -> _db -> add($data);
	}
}



 ?>