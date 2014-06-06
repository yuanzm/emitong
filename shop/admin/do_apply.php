<?php
session_start();
/**
 * Description:
 *
 * Author: Yip
 * Date: 14-3-29 下午7:00
 */

require_once("wechat/Util/MySQL.php");
require_once("wechat/Util/WXCommUtil.php");

$action = $_GET["action"];
//$action = "download";
$id = $_POST["status_id"];
$msg = array(
	'tips' => 'none',
	'success' => 0
);

//审核通过正在办卡
if("pass" == $action) {
	$result = MySQL::updApplyStatus($id, "0");
	if ($result) {
		$msg["tips"] = "提交成功，用户信息通过审核！";
		$msg["success"] = 1;
	}
	else {
		$msg["tips"] = "提交失败，请稍后提交请求。";
	}
}

//没通过审核
else if("unpass" == $action) {
	$result = MySQL::updApplyStatus($id, "-2");
	if ($result) {
		$msg["tips"] = "已提交“用户信息没通过审核”。";
		$msg["success"] = 1;
	}
	else {
		$msg["tips"] = "提交失败，请稍后提交请求。";
	}
}

//已发卡
else if("done" == $action) {
	$result = MySQL::updApplyStatus($id, "1");
	if ($result) {
		$msg["tips"] = "已提交“已发卡”。";
		$msg["success"] = 1;
	}
	else {
		$msg["tips"] = "提交失败，请稍后提交请求。";
	}

}

//正在审核
else if("checking" == $action) {
	$result = MySQL::updApplyStatus($id, "-1");
	if ($result) {
		$msg["tips"] = "已提交“正在审核”。";
		$msg["success"] = 1;
	}
	else {
		$msg["tips"] = "提交失败，请稍后提交请求。";
	}

}


echo json_encode($msg);