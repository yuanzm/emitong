<?php
/**
 * Description: 数据库操作类
 *
 * Author: Yip
 * Date: 14-3-20 下午5:09
 */

if(!defined('MYSQL_PATH')) {
	define('MYSQL_PATH', dirname(dirname(__FILE__)) );
}
require_once(MYSQL_PATH. '/Model/News.php');
require_once(MYSQL_PATH. '/Model/ApplyUser.php');
require_once(MYSQL_PATH. '/Model/ApplyStatus.php');

class MySQL {

	/*
	 * 获取数据库连接
	 *
	 * @return
	 * */
	private function getConn() {

		/*微信端图文菜单设置，参数配置*/
		$dbName = "HZVFWjWuFxywySSSXteG";
		$host = "sqld.duapp.com";
		$port = "4050";
		$ak = "fgTXqN699OOvUKTRnO1OQNty";
		$sk = "RQDDy90TjPiGN4s5tjG6kO3L92jlnu6T";

		//本地测试
		//$dbName = "emi_wechat";
		//$host = "localhost";
		//$ak = "root";
		//$sk = "";

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

	//start: apply_user
	public static function saveApplyUser($open_id=null, $user_id, $user_name, $user_room, $user_qq, $user_phone, $user_mom_ln, $user_iden, $user_idcardfs, $user_idcardbs) {
		$sql = "insert into apply_user(open_id, user_id, user_name, user_room, user_qq, user_phone, user_momln, user_iden, user_idcardfs, user_idcardbs) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$result = false;

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssssssssss", $open_id, $user_id, $user_name, $user_room, $user_qq, $user_phone, $user_mom_ln, $user_iden, $user_idcardfs, $user_idcardbs);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public static function getAllApplyUser() {
		$sql = "select * from apply_user order by id desc";
		$applyUserList = array();

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->execute();
			$ps->bind_result($id, $openId, $userId, $userName, $userRoom, $userQQ, $userPhone, $userMomLn, $userIden, $userIdCardFs, $userIdCardBs);
			while($ps->fetch()) {
				$applyUser = new ApplyUser();
				$applyUser->setId($id);
				$applyUser->setOpenId($openId);
				$applyUser->setUserId($userId);
				$applyUser->setUserName($userName);
				$applyUser->setUserRoom($userRoom);
				$applyUser->setUserQQ($userQQ);
				$applyUser->setUserPhone($userPhone);
				$applyUser->setUserMomLn($userMomLn);
				$applyUser->setUserIden($userIden);
				$applyUser->setIdCardFs($userIdCardFs);
				$applyUser->setIdCardBs($userIdCardBs);
				array_push($applyUserList, $applyUser);
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $applyUserList;
	}

	public static function getApplyUser($id) {
		$sql = "select * from apply_user where id=?";
		$applyUser = new ApplyUser();

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("i", $id);
			$ps->execute();
			$ps->bind_result($id, $openId, $userId, $userName, $userRoom, $userQQ, $userPhone, $userMomLn, $userIden, $userIdCardFs, $userIdCardBs);

			if ($ps->fetch()) {
				$applyUser->setId($id);
				$applyUser->setOpenId($openId);
				$applyUser->setUserId($userId);
				$applyUser->setUserName($userName);
				$applyUser->setUserRoom($userRoom);
				$applyUser->setUserQQ($userQQ);
				$applyUser->setUserPhone($userPhone);
				$applyUser->setUserMomLn($userMomLn);
				$applyUser->setUserIden($userIden);
				$applyUser->setIdCardFs($userIdCardFs);
				$applyUser->setIdCardBs($userIdCardBs);
			}
			else {
				$applyUser = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $applyUser;
	}

	public static function delApplyUser($id) {
		$sql = "delete from apply_user where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
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

	public static function updateApplyUser($id, $user_name, $user_room, $user_qq, $user_phone, $user_mom_ln, $user_iden){
		$sql = "update apply_user set user_name=?, user_room=?, user_qq=?, user_phone=?, user_momln=?, user_iden=? where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssssssi", $user_name, $user_room, $user_qq, $user_phone, $user_mom_ln, $user_iden, $id);
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


	//end: apply_user

	//start: apply_status
	public static function saveApplyStatus($open_id=null, $userId, $status=-1, $download=0) {
		$sql = "insert into apply_status(open_id, user_id, status, download) values (?, ?, ?, ?)";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("ssii", $open_id, $userId, $status, $download);
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

	public static function getApplyStatus($userId) {
		$sql = "select * from apply_status where user_id=?";
		$applyStatus = new ApplyStatus();

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $userId);
			$ps->execute();
			$ps->bind_result($id, $openId, $userId, $status, $download);

			if($ps->fetch()) {
				$applyStatus->setId($id);
				$applyStatus->setOpenId($openId);
				$applyStatus->setUserId($userId);
				$applyStatus->setStatus($status);
				$applyStatus->setDownload($download);
			}
			else {
				$applyStatus = null;
			}

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $applyStatus;
	}

	public static function getAllApplyStatus() {
		$sql = "select * from apply_status";
		$applyStatusList = array();

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->execute();
			$ps->bind_result($id, $openId, $userId, $status, $download);

			while ($ps->fetch()) {
				$applyStatus = new ApplyStatus();
				$applyStatus->setId($id);
				$applyStatus->setOpenId($openId);
				$applyStatus->setUserId($userId);
				$applyStatus->setStatus($status);
				$applyStatus->setDownload($download);
				array_push($applyStatusList, $applyStatus);
			}

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $applyStatusList;
	}
	//用户编号不改
	public static function updApplyStatus($id, $status) {
		$sql = "update apply_status set status=? where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("si", $status, $id);
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

	public static function delApplyStatus($id) {
		$sql = "delete from apply_status where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
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
	//end: apply_status

	//start: emi_man_news
	public static function saveNewsMessage($shopId, $shopType, $articleTitle) {
		$result = false;
		$sql = "insert into emi_man_news(shop_id, shop_type, article_title) values(?, ?, ?)";
		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("sis", $shopId, $shopType, $articleTitle);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public static function delNewsMessage($id) {
		$result = false;
		$sql = "delete from emi_man_news where id=?";
		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
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

	//获取单个图文消息
	public static function getNewsMessage($shop_id) {
		$sql = "select * from emi_man_news where shop_id=?";
		$newsMessage = new News();
		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("s", $shop_id);
			$ps->execute();
			$ps->bind_result($id, $shopId, $shopType, $shopOnline, $articleOrder, $articleTitle, $articleDescription, $articleImgName);
			if ($ps->fetch()) {
				$newsMessage->setId($id);
				$newsMessage->setShopId($shopId);
				$newsMessage->setShopType($shopType);
				$newsMessage->setShopOnline($shopOnline);
				$newsMessage->setArticleOrder($articleOrder);
				$newsMessage->setArticleTitle($articleTitle);
				$newsMessage->setArticleDescription($articleDescription);
				$newsMessage->setArticleImgName($articleImgName);
			}
			else {
				$newsMessage = null;
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $newsMessage;

	}

	//获取所有图文消息
	public static function getAllNewsMessage() {
		$newsMessageList = array();
		$sql = "select * from emi_man_news";
		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->execute();
			$ps->bind_result($id, $shopId, $shopType, $shopOnline, $articleOrder, $articleTitle, $articleDescription, $articleImgName);
			while ($ps->fetch()) {
				$newsMessage = new News();
				$newsMessage->setId($id);
				$newsMessage->setShopId($shopId);
				$newsMessage->setShopType($shopType);
				$newsMessage->setShopOnline($shopOnline);
				$newsMessage->setArticleOrder($articleOrder);
				$newsMessage->setArticleTitle($articleTitle);
				$newsMessage->setArticleDescription($articleDescription);
				$newsMessage->setArticleImgName($articleImgName);
				array_push($newsMessageList, $newsMessage);
			}
			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $newsMessageList;

	}

	//商家编号,商家类型不改，等商家信息修改时再改
	public static function updNeswMessage($id, $shopOnline, $articleOrder, $articleTitle, $articleDescription=null) {
		$result = false;
		$sql = "update emi_man_news set shop_online=?, article_order=?, article_title=?, article_description=? where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("iissi", $shopOnline, $articleOrder, $articleTitle, $articleDescription, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	//修改logo
	public static function updNeswMessageLogo($id, $articleImgName=null) {
		$result = false;
		$sql = "update emi_man_news set article_img_name=? where id=?";

		try {
			$mysql = new MySQL();
			$conn = $mysql->getConn();
			$ps = $conn->prepare($sql);
			$ps->bind_param("si", $articleImgName, $id);
			$result = $ps->execute();

			$ps->close();
			$conn->close();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		return $result;
	}
	//end emi_man_news
}

