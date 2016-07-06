<?php 

namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class DetailController extends CommonController{

	public function index() {
		$id = intval($_GET['id']);

		//读取栏目
 		$barMenus = D('Menu') -> getBarMenus();

 		//广告位新闻查询条件
  		$getAdvNews = array(
 			'position_id' => 3,
 			'status' => 1
 			);
  		//排行榜新闻查询条件
  		$getNews = array(
 			'status' => 1
 			);
  		//读取文章标题
  		$news = D('News') -> find($id);
  		//读取文章内容数据
  		$content = D('NewsContent') -> find($id);
  		$newsContent = htmlspecialchars_decode($content['content']);

  		//读取新闻排行数据
  		$rankNews = $this -> getRank($getNews);

  		//读取广告位新闻数据
   		$advNews = D('PositionContent') -> select($getAdvNews,2);
   		//计数器
   		$count = intval($news['count']) + 1;
   		try{
   			$countId = D('News') -> updateNewsCount($id,$count);
   			if($countId === false){
   				show(0,'计数器运行出错');
   			}
   		}catch(Exception $e) {
   			return show(0,$e->getMessage());
   		}

   		$this -> assign('result',array(
   			'rankNews' => $rankNews,
   			'advNews' => $advNews,
   			'newsContent' => $newsContent,
   			'title' => $news['title'],
   			'news' => $news
   			));
   		$this -> assign('barMenus',$barMenus);
		$this -> display('Detail/index');
	}

	
	//预览功能
	public function view() {
		if(!getLoginUsername()) {
			$this -> error('你没有权限访问该页面');
		}
		$this -> index();
	}

}

 ?>