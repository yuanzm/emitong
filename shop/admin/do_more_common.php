<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description:
 *
 * Author: Yip
 * Date: 14-4-10 下午5:01
 */
require_once("Util/MySQLUtil.php");
require_once("Util/CommonUtil.php");


$action = $_GET["action"];
$more_id = $_GET["more_id"];
$shop_id = $_GET["sid"];

//删除操作
if("d" == $action) {
	$model_shop_more = MySQLUtil::getShopMore($more_id);
	$more_img_name = $model_shop_more->getMoreImgName();

	$dir = CommonUtil::getPhotoDirPrefix("1", $shop_id);
	$del_photo_result = CommonUtil::deleteObjectFromBCS($dir."/".$more_img_name);
	//删除图片成功
	if($del_photo_result) {
		//删除信息
		$more_info_result = MySQLUtil::delShopMore($more_id);
		//删除信息成功
		if($more_info_result) {
			echo "<script>alert('删除成功');location.href='shop_more.php?sid=".$shop_id."';</script>";
		}
	}
	else {
		//todo 若图片不存在处理
		echo "<script>alert('删除图片失败');location='javascript:history.back()';</script>";
	}

}

// 优惠排序
else if("r" == $action) {
	$new_more_order = $_GET["change_more_order"];
	$result = MySQLUtil::checkIfOrderExist($shop_id, $new_more_order);
	if(!$result) {
		$recommend_more_result = MySQLUtil::updShopMoreRecommend($more_id,$new_more_order);
		if($recommend_more_result) {
			echo "<script>alert('修改成功');location.href='shop_more.php?sid=".$shop_id."';</script>";
		}
		else{
			echo "<script>alert('修改失败，请重试');location='javascript:history.back()';</script>";
		}
	}
	else{
		echo "<script>alert('该序号已存在，请更改~');location='javascript:history.back()';</script>";
	}
}