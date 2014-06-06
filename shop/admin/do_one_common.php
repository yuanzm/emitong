<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-9 下午9:49
 */
require_once("Util/MySQLUtil.php");
require_once("Util/CommonUtil.php");


$action = $_GET["action"];
$one_id = $_GET["one_id"];
$shop_id = $_GET["sid"];

//删除操作
if("d" == $action) {
	$model_shop_one = MySQLUtil::getShopOne($one_id);
	$one_img_name = $model_shop_one->getOneImgName();

	$dir = CommonUtil::getPhotoDirPrefix("0", $shop_id);
	$del_photo_result = CommonUtil::deleteObjectFromBCS($dir."/".$one_img_name);
	//删除图片成功
	if($del_photo_result) {
		//删除信息
		$one_info_result = MySQLUtil::delShopOne($one_id);
		//删除信息成功
		if($one_info_result) {
			echo "<script>alert('删除成功');location.href='shop_one.php?sid=".$shop_id."';</script>";
		}
	}
	else {
		//todo 若图片不存在处理
		echo "<script>alert('删除图片失败');location='javascript:history.back()';</script>";
	}

}

//设置推荐
else if("r" == $action) {
	$model_shop_one = MySQLUtil::getShopOne($one_id);
	$one_order = $model_shop_one->getOneOrder();
	if(1==$one_order) {
		$recommend_one_result = MySQLUtil::updShopOneRecommend($one_id,0);
		if($recommend_one_result) {
			echo "<script>alert('取消推荐成功');location.href='shop_one.php?sid=".$shop_id."';</script>";
		}
		else{
			echo "<script>alert('取消推荐失败，请重试');location='javascript:history.back()';</script>";
		}
	}
	else{
		$recommend_one_result = MySQLUtil::updShopOneRecommend($one_id,1);
		if($recommend_one_result) {
			echo "<script>alert('推荐成功');location.href='shop_one.php?sid=".$shop_id."';</script>";
		}
		else{
			echo "<script>alert('推荐失败，请重试');location='javascript:history.back()';</script>";
		}
	}


}