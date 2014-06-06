<?php
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-3-26 下午5:11
 */

if(!defined('COMMON_UTIL_PATH')) {
	define('COMMON_UTIL_PATH', dirname(__FILE__) );
}
require_once(COMMON_UTIL_PATH . '/MyBCSUtil.php');

class CommonUtil{

	public static function createShopId($shopType = "0000"){
		$time = time();
		$shopId = $shopType."_".$time."_".rand(1,100);
		return $shopId;
	}

	public static function createShopHomePhotoName($shopId) {
		$time = time();
		$photoName = "home_".$shopId."_".$time.".jpg";
		return $photoName;
	}

	public static function createShopMorePhotoName($shopId) {
		$time = time();
		$photoName = "more_".$shopId."_".$time.".jpg";
		return $photoName;
	}

	public static function createShopOnePhotoName($shopId) {
		$time = time();
		$photoName = "one_".$shopId."_".$time.".jpg";
		return $photoName;
	}

	public static function createShopLogoPhotoName($shopId) {
		$time = time();
		$photoName = "logo_".$shopId."_".$time.".jpg";
		return $photoName;
	}

	//上传图片
	public static function putObjectToBCS($object, $srcFile) {
		$bcs = new MyBCSUtil();
		$baiduBCS = $bcs->getMyBCS();
		$bcs->setObject($object);
		$bcs->setFileUpload($srcFile);
		try {
			$bcs->create_object($baiduBCS);
			return true;
		}
		catch ( Exception $e ) {
			trigger_error ( $e->getMessage () );
		}
	}
	//删除图片
	public static function deleteObjectFromBCS($object) {
		$bcs = new MyBCSUtil();
		$baiduBCS = $bcs->getMyBCS();
		$bcs->setObject($object);
		try {
			$bcs->delete_object($baiduBCS);
			return true;
		}
		catch ( Exception $e ) {
			trigger_error ( $e->getMessage () );
		}
	}

	//获取图片连接
	public static function getPhotoUrl($object) {
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

	/* @param $type:
	 * shop_one     => 0
	 * shop_more    => 1
	 * shop_home    => 2
	 * @param $shop_id
	 * @return $dir
	 * */
	public static function getPhotoDirPrefix($type,$shop_id) {
		$result_dir = "";
		$comm_dir = "/EmiShopPhotos";
		switch($type) {
			case "0":
				$comm_dir .= "/ShopOne";
				break;
			case "1":
				$comm_dir .= "/ShopMore";
				break;
			case "2";
				$comm_dir .= "/ShopHome";
				break;
			case "3";
				$comm_dir .= "/ShopLogo";
				break;
			default:
				$comm_dir = "";
				break;
		}
		if("" != $comm_dir) {
			$result_dir = $comm_dir . "/" . $shop_id;
			return $result_dir;
		}
		else {
			return $result_dir;
		}

	}



}

