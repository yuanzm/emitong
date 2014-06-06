<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description:
 *
 * Author: Yip
 * Date: 14-4-10 下午4:57
 */
require_once("wechat/Util/MySQL.php");

if(isset($_POST["update_submit"])) {
	//存储字段
	$userName = $_POST["user_name"];
	$userQQ = $_POST["user_qq"];
	$userPhone = $_POST["user_phone"];
	$userRoom = $_POST["user_room"];
	$userMomLn = $_POST["user_mom_ln"];
	$userIden = $_POST["user_iden"];

	$id = $_POST["auid"];

	if("" != $userName && "" != $userPhone && "" != $userRoom && "" != $userMomLn) {
		$update_result = MySQL::updateApplyUser($id, $userName, $userRoom, $userQQ, $userPhone, $userMomLn, $userIden);
		//写入成功
		if($update_result) {
			echo "<script>alert('修改信息成功');location.href='apply_check.php?id=".$id."';</script>";
		}
		//上传成功，写入失败，先删除已经上传的图片
		else
		{
			echo "<script>alert('修改失败');location='javascript:history.back()';</script>";
		}

	}
	else
		echo "<script>alert('必填信息不能为空');location='javascript:history.back()';</script>";
}