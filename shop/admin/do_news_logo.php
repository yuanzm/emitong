<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-15 下午8:54
 */
require_once("Util/CommonUtil.php");
require_once("wechat/Util/MySQL.php");

$article_id = $_POST["nid"];
$shop_id = $_POST["sid"];
$shop_info_id = $_POST["siid"];

//上传图片
if(isset($_POST["pic_upload"])) {
	//允许类型
	$allow_type = array(
		'image/jpeg',
		'image/jpg'
	);
	//允许大小
	$allow_size = 1048576;

	//图片文件信息
	$file_name      = $_FILES["img_name"]["name"];
	$file_size      = $_FILES["img_name"]["size"];
	$file_tmp_path  = $_FILES["img_name"]["tmp_name"];//文件被上传后在服务端储存的临时文件名
	$file_type      = $_FILES["img_name"]["type"];

	if(in_array($file_type, $allow_type) && $file_size <= $allow_size) {
		$article_img_name = CommonUtil::createShopLogoPhotoName($shop_id);
		//构建object
		$prefix = CommonUtil::getPhotoDirPrefix("3", $shop_id);
		$object = $prefix. "/" .$article_img_name;

		//先上传图片，确认成功再写入数据库
		$upload_result = CommonUtil::putObjectToBCS($object, $file_tmp_path);
		//$upload_result=1;
		//上传成功
		if($upload_result) {

			//写入数据库
			$update_resule = MySQL::updNeswMessageLogo($article_id, $article_img_name);
			//$update_resule=0;
			//写入成功
			if($update_resule) {
				echo "<script>alert('写入成功');location.href='shop_web.php?sid=".$shop_id."&siid=".$shop_info_id."';</script>";
			}
			//上传成功，写入失败，先删除已经上传的图片
			else
			{
				CommonUtil::deleteObjectFromBCS($object);
				echo "<script>alert('写入数据失败');location='javascript:history.back()';</script>";
			}
		}
		else
			echo "<script>alert('上传失败');location='javascript:history.back()';</script>";
	}
	else {
		echo "<script>alert('图片不符合要求');location='javascript:history.back()';</script>";
	}
}
else if(isset($_POST["pic_delete"])) {
	$model_article = MySQL::getNewsMessage($shop_id);
	$article_img_name = $model_article->getArticleImgName();
	//构建object
	$prefix = CommonUtil::getPhotoDirPrefix("3",$shop_id);
	$object = $prefix. "/" .$article_img_name;

	$del_logo_result = CommonUtil::deleteObjectFromBCS($object);
	//删除图片成功
	if($del_logo_result) {
		//将图片信息清空
		$article_img_result = MySQL::updNeswMessageLogo($article_id);
		if($article_img_result) {
			echo "<script>alert('删除成功');location.href='shop_web.php?sid=".$shop_id."&siid=".$shop_info_id."';</script>";
		}
	}
	else {
		//todo 若图片不存在处理
		echo "<script>alert('删除图片失败');location='javascript:history.back()';</script>";
	}
}