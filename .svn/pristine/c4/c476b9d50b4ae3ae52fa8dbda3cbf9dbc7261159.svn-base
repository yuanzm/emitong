<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-10 下午4:57
 */
require_once("Util/MySQLUtil.php");

if(isset($_POST["more_update"])) {

	//存储字段
	$more_id             = $_POST["more_id"];
	$more_name           = $_POST["more_name"];
	$more_emi_price      = $_POST["more_emi_price"];      //double TODO 校验
	$more_price          = $_POST["more_price"];          //double TODO 校验
	$more_begin_time     = $_POST["begin_time"];
	$more_end_time       = $_POST["end_time"];
	$more_description    = $_POST["more_description"];      //默认null
	$more_img_name       = $_POST["more_img_name"];
	$more_order          = $_POST["more_order"];

	$shop_id            = $_POST["more_shop_id"];

	if("" != $more_id && "" != $more_name && "" != $more_emi_price && "" != $more_price && "" != $more_begin_time && "" != $more_end_time && "" != $more_img_name) {

		//写入数据库
		$result = MySQLUtil::updShopMore($more_id, $more_name, $more_emi_price, $more_price, $more_begin_time, $more_end_time, $more_description, $more_img_name, $more_order);
		//$save_result=0;
		//写入成功
		if($result) {
			echo "<script>alert('修改成功');location.href='shop_more.php?sid=".$shop_id."';</script>";
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