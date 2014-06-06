<?php
session_start();
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-3-26 上午9:56
 */
require_once("Util/MySQLUtil.php");
require_once("Util/CommonUtil.php");

$action = $_GET["action"];
$msg = array(
	'tips' => 'none',
	'success' => 0
);

//处理增加商家
if("add_info" == $action) {

	$name = $_POST["name"];
	$nickname = $_POST["nickname"];
	$type = $_POST["type"];
	$address = $_POST["address"];
	$description = $_POST["description"];

	//$msg["tips"] = $action." ".$name;
	if("" != $name && "" != $type && "" != $address && "" != $description) {
		//创建一个商家唯一编号，创建时间
		$shopId = CommonUtil::createShopId($type);
		$createTime = time();
		//echo $name;
		//写入数据库
		$result = MySQLUtil::saveShopInfo($shopId, $name, $nickname, $address, $type, $description, $createTime);

		if ($result) {
			$msg["tips"] = "添加成功！";
			$msg["success"] = 1;
		}
		else {
			$msg["tips"] = "增加失败，请确认信息后重新提交。";
			//$msg["success"] = 0;
		}
	}
	else {
		$msg["tips"] = "请填写所有必填字段。";
		//$msg["success"] = 0;
	}
}

//处理修改商家资料
if("upd_info" == $action) {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$nickname = $_POST["nickname"];
	$type = $_POST["type"];
	$address = $_POST["address"];
	$description = $_POST["description"];

	//$msg["tips"] = $action." ".$name;
	if("" != $id && "" != $name && "" != $type && "" != $address && "" != $description) {

		//写入数据库
		$result = MySQLUtil::updShopInfo($id, $name, $nickname, $address, $type, $description);

		if ($result) {
			$msg["tips"] = "修改成功！";
			$msg["success"] = 1;
		}
		else {
			$msg["tips"] = "修改失败，请确认信息后重新提交。";
			//$msg["success"] = 0;
		}
	}
	else {
		$msg["tips"] = "请填写所有必填字段。";
		//$msg["success"] = 0;
	}
}

if("delete" == $action) {

}

echo json_encode($msg);