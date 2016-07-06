<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class ContentController extends Controller{
	
	public function index() {
		$conds = array();
		$title = $_GET['title'];
		if($title){
			$conds['title'] = $title;
		}
		if($_GET['catid']){
			$conds['catid'] = $_GET['catid'];
		}
		$page = $_REQUEST['p']?$_REQUEST['p']:1;
		$pageSize = 2;
		$conds['status'] = array('neq',-1);
		//分页处理
		$news = D('News') -> getNews($conds,$page,$pageSize);
		$count = D('News') -> getNewsCount($conds);
		$webSiteMenu = D('Menu') -> getBarMenus();
		//thinkPHP分页 
		$res = new \Think\Page($count,$pageSize);
		$pageres = $res -> show();

		$positions = D('Position') -> getNormalPosition();
		$this -> assign('positions',$positions);
		$this -> assign('pageres',$pageres);
		$this -> assign('news',$news);
		$this -> assign('webSiteMenu',$webSiteMenu);
		$this -> display();
	}

	public function add(){
		if($_POST) {
			if(!$_POST['title'] ||!isset($_POST['title'])) {
				return show(0,'标题不存在');
			}
			if(!$_POST['small_title'] ||!isset($_POST['small_title'])) {
				return show(0,'短标题不存在');
			}
			if(!$_POST['catid'] ||!isset($_POST['catid'])) {
				return show(0,'文章栏目不存在');
			}
			if(!$_POST['keywords'] ||!isset($_POST['keywords'])) {
				return show(0,'关键字不存在');
			}
			if(!$_POST['content'] ||!isset($_POST['content'])) {
				return show(0,'content不存在');
			}
			if($_POST['news_id']){
				return $this -> save($_POST);
			}
			$data = $_POST;
			$newsId = D('News') -> insert($data);
			if($newsId){
				$newsContentData['content'] = $_POST['content'];
				$newsContentData['news_id'] = $newsId;
				$cId = D('NewsContent') -> insert($newsContentData);
				if($cId) {
					return show(1,'提交成功');
				}
				return show(1,'主表提交成功，副表提交失败');
			}else{
				return show(0,'提交失败');
			}
		}else {
			$webSiteMenu = D('Menu') -> getBarMenus();
			$titleFontColor = C('TITLE_FONT_COLOR');
			$copyFrom = C('COPY_FROM');
			$this -> assign('webSiteMenu',$webSiteMenu);
			$this -> assign('titleFontColor',$titleFontColor);
			$this -> assign('copyFrom',$copyFrom);
			$this -> display();
		}
	}

	public function edit() {
		$newsId = $_GET['id'];
		if(!$newsId){
			$this -> redirect('/R-CMS/admin.php?c=content');
		}
		$news = D('News') -> find($newsId);
		if(!$news){
			$this -> redirect('/R-CMS/admin.php?c=content');
		}
		$newsContent = D('NewsContent') -> find($newsId);
		if($newsContent) {
			$news['content'] = $newsContent['content'];
		}
		$webSiteMenu = D('Menu') -> getBarMenus();
		$this -> assign('webSiteMenu',$webSiteMenu);
		$this -> assign('titleFontColor',C('TITLE_FONT_COLOR'));
		$this -> assign('copyFrom',C('COPY_FROM'));
		$this -> assign('news',$news);
		$this -> display();
	}

	public function save($data) {
		$newsId = $data['news_id'];
		unset($data['news_id']);
		try{
			$id = D('News') -> updateById($newsId,$data);
			$newsContentData['content'] = $data['content'];	
			$conId = D('NewsContent') -> updateNewsById($newsId,$newsContentData);	
			if($id === false || $conId === false) {
				return show(0,'更新失败');
			} 
			return show(1,'更新成功');
		}catch(Exception $e){
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
				$res = D('News') -> updateStatusById($id,$status);
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

	public function listorder(){
		$error=array();
		try{
			if($_POST){
				$listorder = $_POST['listorder'];
				$jumpUrl = $_SERVER['HTTP_REFERER'];
				foreach ($listorder as $newsId => $value) {
					$res = D('News') -> updateListorderById($newsId,$value);
					if ($res === false) {
						$error[] = $newsId;
					}
				}
				if($error) {
					return show(0,'序号'.implode(',', $error).'更新失败',array('jump_url'=>$jumpUrl));
				}
				return show(1,'更新成功',array('jump_url'=>$jumpUrl));
			}
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
		return show(0,'排序数据出错',array('jump_url'=>$jumpUrl));
	}

	public function push() {
		if(!$_POST) {
			return show(0,'数据为空');
		}
		$jumpUrl = $_SERVER['HTTP_REFERER'];
		$newsIds = $_POST['push'];
		$positionId = $_POST['position_id'];
		if(!$positionId){
			return show(0,'请选择推荐位');
		}
		if(!$newsIds || !is_array($newsIds)) {
			return show(0,'请选择推送文章的ID');
		}
		try{
			$news = D('News') -> getNewsByNewsIds($newsIds);
			foreach ($news as $new) {
				$data = array(
					'position_id' => $positionId,
					'title' => $new['title'],
					'thumb' => $new['thumb'],
					'news_id' => $new['news_id'],
					'create_time' => $new['create_time'],
					'status' => 1,
					);
				$position = D('PositionContent') -> insert($data);
			}
		}catch(Exception $e) {
			return show(0,$e->getMessage());
		}
		return show(1,'推荐成功',array('jump_url'=>$jumpUrl));
	}

}


 ?>