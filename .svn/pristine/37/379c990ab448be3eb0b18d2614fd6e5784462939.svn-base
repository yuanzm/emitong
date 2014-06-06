<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-5-4 下午2:33
 */

require_once("wechat/Util/MySQL.php");
require_once("Util/CommonUtil.php");

if(isset($_POST["apply_insert_submit"])) {
	//存储字段
	$userName = $_POST["user_name"];
	$userQQ = $_POST["user_qq"];
	$userPhone = $_POST["user_phone"];
	$userRoom = $_POST["user_room"];
	$userMomLn = $_POST["user_mom_ln"];
	$userIden = $_POST["user_iden"];

	//允许类型
	$allow_type = array(
		'image/jpeg',
		'image/jpg'
	);
	//允许大小
	$allow_size = 1048576;

	//图片文件信息
	$fs_file_name      = $_FILES["user_idcard_fs"]["name"];
	$fs_file_size      = $_FILES["user_idcard_fs"]["size"];
	$fs_file_tmp_path  = $_FILES["user_idcard_fs"]["tmp_name"];//文件被上传后在服务端储存的临时文件名
	$fs_file_type      = $_FILES["user_idcard_fs"]["type"];

	$bs_file_name      = $_FILES["user_idcard_bs"]["name"];
	$bs_file_size      = $_FILES["user_idcard_bs"]["size"];
	$bs_file_tmp_path  = $_FILES["user_idcard_bs"]["tmp_name"];//文件被上传后在服务端储存的临时文件名
	$bs_file_type      = $_FILES["user_idcard_bs"]["type"];

	if("" != $userName && "" != $userPhone && "" != $userIden && "" != $userRoom && "" != $userQQ && "" != $userMomLn && "" != $fs_file_name && "" != $bs_file_name) {
		$time = time();
		$user_id = $time.rand(1,100);
		$user_idcard_fs_name = $time.rand(1,10)."0.jpg";
		$user_idcard_bs_name = $time.rand(1,10)."1.jpg";

		if(in_array($fs_file_type, $allow_type) && in_array($bs_file_type, $allow_type) && $fs_file_size <= $allow_size && $bs_file_size <= $allow_size) {
			//构件object
			$object_fs = "/ApplyUserIdCard/" .$user_id. "/" .$user_idcard_fs_name;
			$object_bs = "/ApplyUserIdCard/" .$user_id. "/" .$user_idcard_bs_name;

			//上传
			$fs_upload_result = CommonUtil::putObjectToBCS($object_fs, $fs_file_tmp_path);
			$bs_upload_result = CommonUtil::putObjectToBCS($object_bs, $bs_file_tmp_path);
//			$fs_upload_result = 1;
//			$bs_upload_result = 1;

			if($fs_upload_result && $bs_upload_result) {
				//写入数据库
				$save_result = MySQL::saveApplyUser(null, $user_id, $userName, $userRoom, $userQQ, $userPhone, $userMomLn, $userIden, $user_idcard_fs_name, $user_idcard_bs_name);
				$status_result = MySQL::saveApplyStatus(null, $user_id);
				//$save_result=0;
				//写入成功
				if($save_result) {
					echo "<script>alert('新增信息成功');location.href='apply_insert.php';</script>";
				}
				//上传成功，写入失败，先删除已经上传的图片
				else
				{
					CommonUtil::deleteObjectFromBCS($object_fs);
					CommonUtil::deleteObjectFromBCS($object_bs);
					echo "<script>alert('写入数据失败');location='javascript:history.back()';</script>";
				}
			}
			else
				echo "<script>alert('上传失败');location='javascript:history.back()';</script>";
		}
		else
			echo "<script>alert('图片必须为JPG格式且小于1M');location='javascript:history.back()';</script>";
	}
	else
		echo "<script>alert('必填信息不能为空');location='javascript:history.back()';</script>";
}
