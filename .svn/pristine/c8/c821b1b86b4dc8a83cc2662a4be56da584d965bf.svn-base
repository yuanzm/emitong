<?php
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-3-30 上午11:12
 */

if(!defined('WXCOMM_UTIL_PATH')) {
	define('WXCOMM_UTIL_PATH', dirname(dirname(dirname(__FILE__))) );
}
require_once(WXCOMM_UTIL_PATH . '/Util/MyBCSUtil.php');

class WXCommUtil {

	//返回用户照片url，可供下载
	public static function getIdCardUrl($userId,$photoName) {
		$prefix = "/ApplyUserIdCard";
		$object = $prefix."/".$userId."/".$photoName;

		//开始获取
		$bcs = new MyBCSUtil();
		$baiduBCS = $bcs->getMyBCS();
		$bcs->setObject($object);
		$url = "";
		try {
			$url = $bcs->generate_get_object_url($baiduBCS);
		}
		catch ( Exception $e ) {
			trigger_error ( $e->getMessage () );
		}
		return $url;
	}

	public static function downloadIdCard($object, $dest_path) {

		$bcs = new MyBCSUtil();
		$baiduBCS = $bcs->getMyBCS();
		$bcs->setObject($object);
		$bcs->setFileWriteTo($dest_path);
		try {
			$bcs->get_object($baiduBCS);
			return true;
		}
		catch ( Exception $e ) {
			trigger_error ( $e->getMessage () );
		}
	}
}


