<?php
/**
 * Description: 管理后台数据库操作类
 *
 * Author: Yip
 * Date: 14-3-22 下午7:48
 */
if(!defined('MYSQL_UTIL_PATH')) {
	define('MYSQL_UTIL_PATH', dirname(dirname(__FILE__)) );
}

require_once(MYSQL_UTIL_PATH. '/Model/Admin.php');
require_once(MYSQL_UTIL_PATH. '/Model/AdminGroup.php');
require_once(MYSQL_UTIL_PATH. '/Model/ShopInfo.php');
require_once(MYSQL_UTIL_PATH. '/Model/ShopMore.php');
require_once(MYSQL_UTIL_PATH. '/Model/ShopOne.php');
require_once(MYSQL_UTIL_PATH. '/Model/ShopType.php');
require_once(MYSQL_UTIL_PATH. '/Model/ShopHome.php');

class MySQLUtil {
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
		// $dbName = "emi_web";
		// $host = "localhost";
		// $ak = "root";
		// $sk = "";

		try {
			$conn = new mysqli($host, $ak, $sk, $dbName, $port);
			//$conn = new mysqli($host, $ak, $sk, $dbName);
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
	public static function saveShopInfo($shopId, $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription, $shopCreateTime) {
		$result = false;
		$sql = "insert into emi_shop_info (shop_id, shop_name, shop_nickname, shop_address, shop_type, shop_description, shop_create_time) values (?, ?, ?, ?, ?, ?, ?)";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssssiss", $shopId, $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription, $shopCreateTime);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}

		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;

	}

	public static function delShopInfo($id) {
		$result = false;
		$sql = "delete from emi_shop_info where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public static function getShopInfo($id) {
		$sql = "select * from emi_shop_info where id=?";
		$shopInfo = new ShopInfo();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
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

	public static function getAllShopInfo() {
		$shopInfoList = array();
		$sql = "select * from emi_shop_info";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->execute();
			$ps->bind_result($id, $shopId, $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription, $shopCreateTime);

			while($ps->fetch()) {
				$shopInfo = new ShopInfo();
				$shopInfo->setId($id);
				$shopInfo->setShopId($shopId);
				$shopInfo->setShopName($shopName);
				$shopInfo->setShopNickName($shopNickName);
				$shopInfo->setShopAddress($shopAddress);
				$shopInfo->setShopType($shopType);
				$shopInfo->setShopDescription($shopDescription);
				$shopInfo->setShopCreateTime($shopCreateTime);
				array_push($shopInfoList, $shopInfo);
			}
			$ps->close();
			$conn->close();
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		return $shopInfoList;
	}
	//创建时间和商家编号不改
	public static function updShopInfo($id, $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription) {
		$result = false;
		$sql = "update emi_shop_info set shop_name=?, shop_nickname=?, shop_address=?, shop_type=?, shop_description=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("sssisi", $shopName, $shopNickName, $shopAddress, $shopType, $shopDescription, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;

	}
	//END: emi_shop_info

	//START: emi_shop_more
	public static function saveShopMore($shopId, $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription="", $moreImgName, $moreCreateTime) {
		$result = false;
		$sql = "insert into emi_shop_more (shop_id, more_name, more_emi_price, more_price, more_begin_time, more_end_time, more_description, more_img_name, more_create_time) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssddsssss", $shopId, $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription, $moreImgName, $moreCreateTime);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;

	}

	public static function delShopMore($id) {
		$result = false;
		$sql = "delete from emi_shop_more where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}

		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public static function getShopMore($id) {
		$sql = "select * from emi_shop_more where id=?";
		$shopMore = new ShopMore();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
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
	public static function getAllShopMore($shop_id) {
		$sql = "select * from emi_shop_more where shop_id=? order by more_order";
		$shopMoreList = array();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
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

	//创建时间和商家编号不改
	public static function updShopMore($id, $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription, $moreImgName, $moreOrder) {
		$result = false;
		$sql = "update emi_shop_more set more_name=?, more_emi_price=?, more_price=?, more_begin_time=?, more_end_time=?, more_description=?, more_img_name=?, more_order=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("sddssssii", $moreName, $moreEmiPrice, $morePrice, $moreBeginTime, $moreEndTime, $moreDescription, $moreImgName, $moreOrder, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	//修改优惠排序
	public static function updShopMoreRecommend($id, $more_order) {
		$result = false;
		$sql = "update emi_shop_more set more_order=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ii", $more_order, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}
	//检查商家的某个序号的优惠是否存在
	public static function checkIfOrderExist($shop_id, $more_order) {
		$result = false;
		$sql = "select * from emi_shop_more where more_order=? and shop_id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("is", $more_order, $shop_id);
			$ps->execute();
			if($ps->fetch()) {
				$result = true;
			}

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}
	//END: em_shop_more

	//START: emi_shop_one
	public static function saveShopOne($shopId, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneCreateTime) {
		$result = false;
		$sql = "insert into emi_shop_one (shop_id, one_name, one_emi_price, one_price, one_begin_time, one_end_time, one_description, one_img_name, one_create_time) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssddsssss", $shopId, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneCreateTime);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;

	}

	public static function delShopOne($id) {
		$result = false;
		$sql = "delete from emi_shop_one where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}

		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public static function getShopOne($id) {
		$sql = "select * from emi_shop_one where id=?";
		$shopOne = new ShopOne();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
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
	//获取某一商户的所有推荐
	public static function getAllShopOne($shop_id) {
		$sql = "select * from emi_shop_one where shop_id=?";
		$shopOneList = array();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
			$ps->execute();
			$ps->bind_result($id, $shopId, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneCreateTime, $oneOrder);

			while($ps->fetch()) {
				$shopOne = new ShopOne();
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

				array_push($shopOneList,$shopOne);
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopOneList;

	}
	//创建时间和商家编号不改
	public static function updShopOne($id, $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneOrder) {
		$result = false;
		$sql = "update emi_shop_one set one_name=?, one_emi_price=?, one_price=?, one_begin_time=?, one_end_time=?, one_description=?, one_img_name=?, one_order=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("sddssssii", $oneName, $oneEmiPrice, $onePrice, $oneBeginTime, $oneEndTime, $oneDescription, $oneImgName, $oneOrder, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}
	//修改推荐排序
	public static function updShopOneRecommend($id, $one_order) {
		$result = false;
		$sql = "update emi_shop_one set one_order=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ii", $one_order, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}
	//END: emi_shop_one

	//START: emi_admin
	public static function getAdmin($adminName) {
		$sql = "select * from emi_admin where admin_name=?";
		$admin = new Admin();
		try {

			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $adminName);
			$ps->execute();
			$ps->bind_result($id, $adminName, $adminPwd, $adminEmail, $adminPhone, $adminGroup, $adminRealName);
			if($ps->fetch()) {
				$admin->setId($id);
				$admin->setAdminName($adminName);
				$admin->setAdminPwd($adminPwd);
				$admin->setAdminEmail($adminEmail);
				$admin->setAdminPhone($adminPhone);
				$admin->setAdminGroup($adminGroup);
				$admin->setAdminRealName($adminRealName);

			}
			else {
				$admin = null;
			}
			$ps->close();
			$conn->close();


		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $admin;
	}
	//END: emi_admin

	//START: emi_admin_group
	public static function getAdminGroup($id) {
		$sql = "select * from emi_admin_group where id=?";
		$adminGroup = new AdminGroup();
		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();
			$ps->bind_result($id, $groupName, $groupPrivilege, $groupDescription);
			if($ps->fetch()) {
				$adminGroup->setId($id);
				$adminGroup->setGroupName($groupName);
				$adminGroup->setGroupPrivilege($groupPrivilege);
				$adminGroup->setGroupDescription($groupDescription);
			}
			else {
				$adminGroup = null;
			}
			$ps->close();
			$conn->close();

		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $adminGroup;
	}
	//END: emi_admin_group

	//START: emi_shop_type
	public static function saveShopType($typeName, $typeCount) {
		$sql = "insert into emi_shop_type (type_name, type_count) values (?, ?)";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("si", $typeName, $typeCount);
			$ps->execute();

			$ps->close();
			$conn->close();
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public static function delShopType($id) {
		$sql = "delete from emi_shop_type where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();

			$ps->close();
			$conn->close();
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public static function getShopType($id) {
		$sql = "select * from emi_shop_type where id=?";
		$shopType = new ShopType();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();
			$ps->bind_result($id, $typeName, $typeCount);

			if($ps->fetch()) {
				$shopType->setId($id);
				$shopType->setTypeName($typeName);
				$shopType->setTypeCount($typeCount);
			}
			else {
				$shopType = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $shopType;
	}

	public static function getAllShopType() {
		$sql = "select * from emi_shop_type";
		$shopTypeList = array();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->execute();
			$ps->bind_result($id, $typeName, $typeCount);

			while($ps->fetch()) {
				$shopType = new ShopType();
				$shopType->setId($id);
				$shopType->setTypeName($typeName);
				$shopType->setTypeCount($typeCount);
				array_push($shopTypeList, $shopType);
			}
			$ps->close();
			$conn->close();

		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		return $shopTypeList;
	}

	public static function updShopType($id, $typeName, $typeCount) {
		$sql = "update emi_shop_type set type_name=?, type_count=? where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssi", $typeName, $typeCount, $id);
			$ps->execute();

			$ps->close();
			$conn->close();
			return true;
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}
	//END: emi_shop_type

	//start: emi_shop_home
	public static function saveShopHome($shop_id, $home_img_name) {
		$sql = "insert into emi_shop_home (shop_id, home_img_name) values (?, ?)";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ss", $shop_id, $home_img_name);
			$ps->execute();

			$ps->close();
			$conn->close();
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public static function delShopHome($id) {
		$sql = "delete from emi_shop_home where id=?";

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();

			$ps->close();
			$conn->close();
			return true;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}
	//获取商家的有图片记录
	public static function getAllShopHome($shop_id) {
		$sql = "select * from emi_shop_home where shop_id=?";
		$shopHomeList = array();

		try {
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
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
			$mysqlUtil = new MySQLUtil();
			$conn = $mysqlUtil->getConn();
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
