<?php 

namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class ContentController extends Controller{
	
	public function index() {
		// $data = D('News') -> getNews();
		// if(!$data || !is_array($data)){
		// 	return show(0,'数据出错');
		// }
		// $this -> assign('data',$data);
		$res = D('Menu') -> getBarMenus(); 
		$this -> assign('data',$res);
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
			$data = $_POST;
			$newsId = D('News') -> insert($data);
			if($newsId){
				$newsContentData['content'] = $_POST['content'];
				$newsContentData['news_id'] = $newsId;
				$cId = D('NewsContent') -> insert($newsContentData);
				if($cId) {
					return show(1,'提交成功');
				}
				return show(0,'主表提交成功，副表提交失败');
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
}


 ?>