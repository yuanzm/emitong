<?php
/**
 * Description: 数据库操作类
 *
 * Author: Yip
 * Date: 14-4-25 下午13:33
 */

if(!defined('SHOP_DIR')) {
	define('SHOP_DIR', dirname(dirname(dirname(__FILE__))));
}
//引用model包
require_once(SHOP_DIR. '/admin/Model/ShopInfo.php');
require_once(SHOP_DIR. '/admin/Model/ShopMore.php');
require_once(SHOP_DIR. '/admin/Model/ShopOne.php');
require_once(SHOP_DIR. '/admin/Model/ShopType.php');
require_once(SHOP_DIR. '/admin/Model/ShopHome.php');

class ShopMySQL {
	/*
	 * 获取数据库连接
	 *
	 * @return
	 * */
	private function getConn() {

		/*连接参数配置*/
		$dbName = "AjsMaAOuoqdhLpaEvAHo";
		$host = "sqld.duapp.com";
		$port = "4050";
		$ak = "PuVxl95jdqd80P7ydQ9eGnpm";
		$sk = "M9yzNGC7h3p62hwdOGpVuovjwUScGacz";

		/*本地连接参数配置*/
		// $dbName = "AjsMaAOuoqdhLpaEvAHo";
		// $host = "localhost";
		// $ak = "root";
		// $sk = "trf153.";

		try {
			$conn = new mysqli($host, $ak, $sk, $dbName, $port);
			// $conn = new mysqli($host, $ak, $sk, $dbName);
			if(!$conn) {
				die("Connect Server Failed: " . mysqli_error($conn));
			}
			$conn->set_charset("utf8");//设置编码utf8
			return $conn;
		}
		catch (mysqli_sql_exception $e) {
			throw $e;
		}

	}

	//START: emi_shop_info

	public static function getShopInfo($shop_id) {
		$sql = "select * from emi_shop_info where shop_id=?";
		$shopInfo = new ShopInfo();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
			$ps->execute();
			$ps->bind_result($id, $shopId, $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription, $shopCreateTime);

			if($ps->fetch()) {
				$shopInfo->setId($id);
				$shopInfo->setShopId($shopId);
				$shopInfo->setShopName($shopName);
				$shopInfo->setShopNickName($shopNickName);
				$shopInfo->setShopAddress($shopAddress);
				$shopInfo->setShopType($shopType);
				$shopInfo->setShopDescription($shopDescription);
				$shopInfo->setShopCreateTime($shopCreateTime);
			}
			else {
				$shopInfo = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopInfo;
	}

	//END: emi_shop_info

	//START: emi_shop_more

	public static function getShopMore($id) {
		$sql = "select * from emi_shop_more where id=?";
		$shopMore = new ShopMore();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();
			$ps->bind_result($id, $shopId, $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription, $moreImgName, $moreCreateTime, $moreOrder);

			if($ps->fetch()) {
				$shopMore->setId($id);
				$shopMore->setShopId($shopId);
				$shopMore->setMoreName($moreName);
				$shopMore->setMoreEmiPrice($moreEmiPrice);
				$shopMore->setMorePrice($morePrice);
				$shopMore->setMoreBeginTime($moreBeginTime);
				$shopMore->setMoreEndTime($moreEndTime);
				$shopMore->setMoreDescription($moreDescription);
				$shopMore->setMoreImgName($moreImgName);
				$shopMore->setMoreCreateTime($moreCreateTime);
				$shopMore->setMoreOrder($moreOrder);
			}
			else {
				$shopMore = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopMore;
	}
	//获取某一商户的所有优惠
	public static function getAllShopMore($shop_id, $index=0, $amount=8) {
		$sql = "select * from emi_shop_more where shop_id=? order by more_order limit ?,?";
		$shopMoreList = array();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("sii", $shop_id, $index, $amount);
			$ps->execute();
			$ps->bind_result($id, $shopId, $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription, $moreImgName, $moreCreateTime, $moreOrder);

			while($ps->fetch()) {
				$shopMore = new ShopMore();
				$shopMore->setId($id);
				$shopMore->setShopId($shopId);
				$shopMore->setMoreName($moreName);
				$shopMore->setMoreEmiPrice($moreEmiPrice);
				$shopMore->setMorePrice($morePrice);
				$shopMore->setMoreBeginTime($moreBeginTime);
				$shopMore->setMoreEndTime($moreEndTime);
				$shopMore->setMoreDescription($moreDescription);
				$shopMore->setMoreImgName($moreImgName);
				$shopMore->setMoreCreateTime($moreCreateTime);
				$shopMore->setMoreOrder($moreOrder);

				array_push($shopMoreList,$shopMore);
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopMoreList;

	}

	//END: em_shop_more

	//START: emi_shop_one
	public static function getShopOne($shop_id) {
		$sql = "select * from emi_shop_one where shop_id=? order by one_order limit 1";
		$shopOne = new ShopOne();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
			$ps->execute();
			$ps->bind_result($id, $shopId, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneCreateTime, $oneOrder);

			if($ps->fetch()) {
				$shopOne->setId($id);
				$shopOne->setShopId($shopId);
				$shopOne->setOneName($oneName);
				$shopOne->setOneEmiPrice($oneEmiPrice);
				$shopOne->setOnePrice($onePrice);
				$shopOne->setOneBeginTime($oneBeginTime);
				$shopOne->setOneEndTime($oneEndTime);
				$shopOne->setOneDescription($oneDescription);
				$shopOne->setOneImgName($oneImgName);
				$shopOne->setOneCreateTime($oneCreateTime);
				$shopOne->setOneOrder($oneOrder);
			}
			else {
				$shopOne = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopOne;

	}
//	//获取某一商户的所有推荐
//	public static function getAllShopOne($shop_id) {
//		$sql = "select * from emi_shop_one where shop_id=?";
//		$shopOneList = array();
//
//		try {
//			$mysql = new ShopMySQL();
//			$conn = $mysql->getConn();
//			$ps = $conn->prepare($sql);
//			$ps->bind_param("s", $shop_id);
//			$ps->execute();
//			$ps->bind_result($id, $shopId, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneCreateTime, $oneOrder);
//
//			while($ps->fetch()) {
//				$shopOne = new ShopOne();
//				$shopOne->setId($id);
//				$shopOne->setShopId($shopId);
//				$shopOne->setOneName($oneName);
//				$shopOne->setOneEmiPrice($oneEmiPrice);
//				$shopOne->setOnePrice($onePrice);
//				$shopOne->setOneBeginTime($oneBeginTime);
//				$shopOne->setOneEndTime($oneEndTime);
//				$shopOne->setOneDescription($oneDescription);
//				$shopOne->setOneImgName($oneImgName);
//				$shopOne->setOneCreateTime($oneCreateTime);
//				$shopOne->setOneOrder($oneOrder);
//
//				array_push($shopOneList,$shopOne);
//			}
//			$ps->close();
//			$conn->close();
//		}
//		catch (Exception $e) {
//			echo $e->getMessage();
//		}
//		return $shopOneList;
//
//	}
	//END: emi_shop_one



	//start: emi_shop_home
	//获取商家的有图片记录
	public static function getAllShopHome($shop_id) {
		$sql = "select * from emi_shop_home where shop_id=?";
		$shopHomeList = array();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
			$ps->execute();
			$ps->bind_result($id, $shop_id, $home_img_name);

			while($ps->fetch()) {
				$shopHome = new ShopHome();
				$shopHome->setId($id);
				$shopHome->setShopId($shop_id);
				$shopHome->setHomeImgName($home_img_name);
				array_push($shopHomeList, $shopHome);
			}
			$ps->close();
			$conn->close();

		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		return $shopHomeList;
	}
	//查询单条记录
	public static function getShopHome($id) {
		$sql = "select * from emi_shop_home where id=?";
		$shopHome = new ShopHome();

		try {
			$mysql = new ShopMySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();
			$ps->bind_result($id, $shop_id, $home_img_name);

			if($ps->fetch()) {
				$shopHome->setId($id);
				$shopHome->setShopId($shop_id);
				$shopHome->setHomeImgName($home_img_name);
			}
			else {
				$shopHome = null;
			}
			$ps->close();
			$conn->close();
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		return $shopHome;
	}
	//end: emi_shop_home



}
