<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description:
 *
 * Author: Yip
 * Date: 14-4-7 下午8:36
 */
require_once("Util/MySQLUtil.php");

if(isset($_POST["one_update"])) {

	//存储字段
	$one_id             = $_POST["one_id"];
	$one_name           = $_POST["one_name"];
	$one_emi_price      = $_POST["one_emi_price"];      //double TODO 校验
	$one_price          = $_POST["one_price"];          //double TODO 校验
	$one_begin_time     = $_POST["begin_time"];
	$one_end_time       = $_POST["end_time"];
	$one_description    = $_POST["one_description"];
	$one_img_name       = $_POST["one_img_name"];
	$one_order          = $_POST["one_order"];

	$shop_id            = $_POST["one_shop_id"];

	if("" != $one_id && "" != $one_name && "" != $one_emi_price && "" != $one_price && "" != $one_begin_time && "" != $one_end_time && "" != $one_description && "" != $one_img_name) {

		//写入数据库
		$result = MySQLUtil::updShopOne($one_id, $one_name, $one_emi_price, $one_price, $one_begin_time, $one_end_time, $one_description, $one_img_name, $one_order);
		//$save_result=0;
		//写入成功
		if($result) {
			echo "<script>alert('修改成功');location.href='shop_one.php?sid=".$shop_id."';</script>";
		}
		//写入失败
		else
		{
			echo "<script>alert('提交修改失败，请稍后重试');location='javascript:history.back()';</script>";
		}
	}
	else
		echo "<script>alert('必填字段不能为空');location='javascript:history.back()';</script>";


}
//print_r($_POST);