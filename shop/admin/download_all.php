<?php
session_start();
?>

<!doctype html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>导出</title>
</head>
<body>
	<form action="" method="post">
		<input type="submit" name="download_all" value="开始导出"/>
	</form>
</body>
</html>

<?php

/**
 * Description:
 *
 * Author: Yip
 * Date: 14-4-4 下午11:54
 */
//require_once("Util/CommonUtil.php");
//require_once("wechat/Util/WXCommUtil.php");
//require_once("wechat/Util/MySQL.php");

//获取数据库链接
function getConn() {
	$dbName = "emi_wechat";
	$host = "localhost";
	$ak = "root";
	$sk = "";

	try {
		//$conn = new mysqli($host, $ak, $sk, $dbName, $port);
		$conn = new mysqli($host, $ak, $sk, $dbName);
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
//获取用户状态
function getDownloadUser() {
	$sql = "select * from apply_status where status=0 and download=0";
	$applyStatusList = array();

	try {
		$conn = getConn();
		$ps = $conn->prepare($sql);
		$ps->bind_result($id, $open_id, $user_id, $status, $download);
		$ps->execute();
		while($ps->fetch()) {
			$applyStatus = new ApplyStatus();
			$applyStatus->setId($id);
			$applyStatus->setOpenId($open_id);
			$applyStatus->setUserId($user_id);
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

//获取用户信息
function getApplyUser($user_id) {

	$sql = "select * from apply_user where user_id = ?";
	$applyUser = new ApplyUser();
	try {
		$conn = getConn();
		$ps = $conn->prepare($sql);
		$ps->bind_param("s", $user_id);
		$ps->bind_result($id, $openId, $userId, $userName, $userRoom, $userPhone, $userMomLn, $userIdCardFs, $userIdCardBs);
		$ps->execute();

		if($ps->fetch()) {
			$applyUser = new ApplyUser();
			$applyUser->setId($id);
			$applyUser->setOpenId($openId);
			$applyUser->setUserId($userId);
			$applyUser->setUserName($userName);
			$applyUser->setUserRoom($userRoom);
			$applyUser->setUserPhone($userPhone);
			$applyUser->setUserMomLn($userMomLn);
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

function updateStatus($user_id) {
	$sql = "update apply_status set download=1 where user_id=?";
	$result = false;

	try {
		$conn = getConn();
		$ps = $conn->prepare($sql);
		$ps->bind_param("s", $user_id);
		$result = $ps->execute();
		return $result;
	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
	return $result;
}

//下载用户照片
function downloadPhoto($object,$dest) {
	$result = WXCommUtil::downloadIdCard($object, $dest);
	return $result;
}


if(isset($_POST["download_all"])) {

	$list = getDownloadUser();

//	echo "<table>";
//		echo "<tr>";
//			//echo "<td>编号</td>";
//			echo "<td>姓名</td>";
//			echo "<td>电话</td>";
//			echo "<td>地址</td>";
//			echo "<td>母亲姓氏</td>";
//		echo "</tr>";
	//-----导出部分
	$home_dir = "E:/ApplyUserIdCard";
	$out_time_dir = $home_dir."/".time();

	if(!file_exists($out_time_dir)) {
		mkdir($out_time_dir,0777);
	}
	//-----导出部分

	foreach($list as $applyStatus) {
		$uid = $applyStatus->getUserId();
		$applyUser = getApplyUser($uid);

		$user_name = $applyUser->getUserName();
//		$user_phone = $applyUser->getUserPhone();
//		$user_room = $applyUser->getUserRoom();
//		$user_mom_ln = $applyUser->getUserMomLn();
//		echo "<tr>";
//
//			//echo "<td>".$i++."</td>";
//			echo "<td>".$user_name."</td>";
//			echo "<td>".$user_phone."</td>";
//			echo "<td>".$user_room."</td>";
//			echo "<td>".$user_mom_ln."</td>";
//
//		echo "</tr>";

		//-----导出部分
		$user_idcardfs = $applyUser->getIdCardFs();
		$user_idcardbs = $applyUser->getIdCardBs();
		//构件object和下载文件夹、文件名
		$object_fs = "/ApplyUserIdCard/" .$uid. "/" .$user_idcardfs;
		$object_bs = "/ApplyUserIdCard/" .$uid. "/" .$user_idcardbs;

		$user_img_path = $out_time_dir ."/". $uid;
		if(!file_exists($user_img_path)) {
			mkdir($user_img_path,0777);
		}
		$dest_fs = $user_img_path ."/". $user_idcardfs;
		$dest_bs = $user_img_path ."/". $user_idcardbs;
		//---------------开始导出---------------------//
		echo "姓名：".$user_name;
		echo "\t";
		echo "UID:".$uid;
		echo "\t";

		$result_fs = downloadPhoto($object_fs, $dest_fs);
		echo "正面照导出：";
		if($result_fs)
			echo "成功";
		else
			echo "失败";

		echo "\t";

		echo "反面照导出：";
		$result_bs = downloadPhoto($object_bs, $dest_bs);
		if($result_bs)
			echo "成功";
		else
			echo "失败";

		echo "\t";

		//--------------修改导出状态----------------//
		echo "修改状态：";

		if($result_bs && $result_fs){
			$result_upd = updateStatus($uid);
			if($result_upd)
				echo "成功";
			else
				echo "失败";
		}
		else
			echo "导出失败-导致不修改";

		echo "<br>";
		//-----导出部分

	}
//	echo "</table>";
}