<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-7 下午8:16
 */
require_once("Util/CommonUtil.php");
require_once("Util/MySQLUtil.php");

if(isset($_POST["one_new_submit"])) {

	//存储字段
	$shop_id            = $_POST["shop_id"];
	$one_name           = $_POST["one_name"];
	$one_emi_price      = $_POST["one_emi_price"];      //double TODO 校验
	$one_price          = $_POST["one_price"];          //double TODO 校验
	$one_begin_time     = $_POST["begin_time"];
	$one_end_time       = $_POST["end_time"];
	$one_description    = $_POST["one_description"];

	//允许类型
	$allow_type = array(
		'image/jpeg',
		'image/jpg'
	);
	//允许大小
	$allow_size = 1048576;

	//图片文件信息
	$file_name      = $_FILES["one_img"]["name"];
	$file_size      = $_FILES["one_img"]["size"];
	$file_tmp_path  = $_FILES["one_img"]["tmp_name"];//文件被上传后在服务端储存的临时文件名
	$file_type      = $_FILES["one_img"]["type"];

	if("" != $shop_id && "" != $one_name && "" != $one_emi_price && "" != $one_price && "" != $one_begin_time && "" != $one_end_time && "" != $one_description) {
		$one_img_name = CommonUtil::createShopOnePhotoName($shop_id);
		$one_create_time = time();

		//图片符合要求
		if(in_array($file_type, $allow_type) && $file_size <= $allow_size) {
			//构建object
			$object = "/EmiShopPhotos/ShopOne/" . $shop_id . "/" .$one_img_name;

			//先上传图片，确认成功再写入数据库
			$upload_result = CommonUtil::putObjectToBCS($object, $file_tmp_path);
			//$upload_result=1;
			//上传成功
			if($upload_result) {
				//写入数据库
				$save_result = MySQLUtil::saveShopOne($shop_id, $one_name, $one_emi_price, $one_price, $one_begin_time, $one_end_time, $one_description, $one_img_name, $one_create_time);
				//$save_result=0;
				//写入成功
				if($save_result) {
					echo "<script>alert('提交成功');location.href='shop_one.php?sid=".$shop_id."';</script>";
				}
				//上传成功，写入失败，先删除已经上传的图片
				else
				{
					CommonUtil::deleteObjectFromBCS($object);
					echo "<script>alert('写入失败');location='javascript:history.back()';</script>";
				}

			}
			else
				echo "<script>alert('上传失败');location='javascript:history.back()';</script>";
		}
		else
			echo "<script>alert('图片不符合要求');location='javascript:history.back()';</script>";

	}


}
//print_r($_POST);
//print_r($_FILES);