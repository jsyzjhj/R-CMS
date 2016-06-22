<?php 

namespace Common\Model;
use Think\Model;
/**
* 
*/
class UploadImageModel extends Model{
	private $_uploadObj = '';
	private $_uploadImageData = '';

	const UPLOAD = 'upload';
	public function __construct(){
		# code...
		$this->_uploadObj = new \Think\Upload();
		//上传保存的根路径
		$this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
		//子目录创建方式，采用数组或者字符串方式定义
		$this->_uploadObj->subName = date(Y) . '/' .date(m). '/' .date(d);
	}

	public function upload() {
		$res = $this->_uploadObj->upload();

		if($res) {
			return '/R-CMS/'.self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
		}else {
			return false;
		}
	}

	public function imageUpload() {
		$res = $this->_uploadObj->upload();
		// print_r($res);
		if($res) {
			return '/R-CMS/'.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
		}else {
			return false;
		}
	}
}


 ?>