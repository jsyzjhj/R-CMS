<?php 

namespace Home\Controller;
use Think\Controller;

/**
* 
*/
class CatController extends CommonController{
	
	public function index() {
		if(!$_GET['id']) {
			return show(0,'选择栏目ID出错');
		}
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

  		//当前栏目对应新闻查询条件
  		$getCatNews = array(
  			'status' => 1,
  			'catid' => $id
  			);

  		//读取新闻排行数据
  		$rankNews = $this -> getRank($getNews);

  		//读取当前栏目对应新闻数据
  		//并进行分页处理
  		$page = $_REQUEST['p']?$_REQUEST['p']:1;
		  $pageSize = 2;
		  //分页处理
		  $newsPage = D('News') -> getNews($getCatNews,$page,$pageSize);
		  $count = D('News') -> getNewsCount($conds);
		  //thinkPHP分页 
		  $res = new \Think\Page($count,$pageSize);
		  $pageres = $res -> show();

  		//读取广告位新闻数据
   		$advNews = D('PositionContent') -> select($getAdvNews,2);
   		
      $news['catid'] = $id;

   		$this -> assign('result',array(
   			'newsPage' => $newsPage,
   			'rankNews' => $rankNews,
   			'advNews' => $advNews,
   			'pageres' => $pageres,
        'news' => $news
   			));
  		$this -> assign('barMenus',$barMenus);
		$this -> display();
	}
}

 ?>