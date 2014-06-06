<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-5-4 下午3:55
 */

require_once("wechat/Util/MySQL.php");
require_once("Util/CommonUtil.php");

$apply_user_id = $_GET["auid"];
$apply_status_id = $_GET["asid"];

if(""!=$apply_user_id && ""!=$apply_status_id) {

	$model_apply_user = MySQL::getApplyUser($apply_user_id);

	if(null != $model_apply_user) {
		$user_id = $model_apply_user->getUserId();
		$open_id = $model_apply_user->getOpenId();
		$user_idcard_fs_name = $model_apply_user->getIdCardFs();
		$user_idcard_bs_name = $model_apply_user->getIdCardBs();

		$object_fs = "/ApplyUserIdCard/" .$user_id. "/" .$user_idcard_fs_name;
		$object_bs = "/ApplyUserIdCard/" .$user_id. "/" .$user_idcard_bs_name;

		if("" == $open_id || null == $open_id) {

			CommonUtil::deleteObjectFromBCS($object_fs);
			CommonUtil::deleteObjectFromBCS($object_bs);

			$re_del_apply_status = MySQL::delApplyStatus($apply_status_id);
			$re_del_apply_user = MySQL::delApplyUser($apply_user_id);

			if($re_del_apply_status && $re_del_apply_user) {
				echo "<script>alert('删除成功');location.href='apply_user.php';</script>";
			}
			else{
				echo "<script>alert('删除失败，请联系管理员');location='javascript:history.back()';</script>";
			}

		}
		else {
			echo "<script>alert('不可以删除已绑定的用户信息');location='javascript:history.back()';</script>";
		}
	}

}