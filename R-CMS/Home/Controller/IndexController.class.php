<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {

 	function index($type = ''){
 		$basic = D('Basic') -> select();
 		$barMenus = D('Menu') -> getBarMenus();
 		$getBigPosition = array(
 			'position_id' => 1,
 			'status' => 1
 			);
 		$getSmallPosition = array(
 			'position_id' => 2,
 			'status' => 1
 			);
 		$getNews = array(
 			'status' => 1
 			);
 		$getAdvNews = array(
 			'position_id' => 3,
 			'status' => 1
 			);
 		$bigPositions = D('PositionContent') -> select($getBigPosition,1);
 		$smallPositions = D('PositionContent') -> select($getSmallPosition,3);

 		$advNews = D('PositionContent') -> select($getAdvNews,2);
 		$news = D('News') -> select($getNews,20);
 		$rankNews = $this -> getRank($getNews);

 		$this -> assign('result',array(
 			'bigPositions' => $bigPositions[0],
 			'smallPositions' => $smallPositions,
 			'news' => $news,
 			'rankNews' => $rankNews,
 			'advNews' => $advNews
 			));
 		$this -> assign('barMenus',$barMenus);
 		$this -> assign('basic',$basic);
 		//生成页面静态化
 		if($type == 'buildHtml') {
 			$this -> buildHtml('index',HTML_PATH,'Index/index');
 		}else {
 			$this -> display();
 		}
 	}

 	public function build_html() {
 		$this -> index('buildHtml');
 	}
}