<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-14 下午7:57
 */

$action = $_GET["action"];
$home_id = $_GET["hid"];
$shop_id = $_GET["sid"];

if("d" == $action) {
	require_once("Util/MySQLUtil.php");
	require_once("Util/CommonUtil.php");

	$model_shop_home = MySQLUtil::getShopHome($home_id);
	$home_img_name = $model_shop_home->getHomeImgName();

	$dir = CommonUtil::getPhotoDirPrefix("2", $shop_id);
	$del_photo_result = CommonUtil::deleteObjectFromBCS($dir."/".$home_img_name);
	//删除图片成功
	if($del_photo_result) {
		//删除信息
		$home_info_result = MySQLUtil::delShopHome($home_id);
		//删除信息成功
		if($home_info_result) {
			echo "<script>alert('删除成功');location.href='shop_home.php?sid=".$shop_id."';</script>";
		}
	}
	else {
		//todo 若图片不存在处理
		echo "<script>alert('删除图片失败');location='javascript:history.back()';</script>";
	}
}