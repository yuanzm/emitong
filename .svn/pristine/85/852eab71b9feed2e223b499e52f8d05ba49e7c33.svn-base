<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-13 下午2:43
 */

require_once("wechat/Util/MySQL.php");
require_once("Util/MySQLUtil.php");

$action = $_GET["action"];
$msg = array(
	'tips' => '无提示消息',
	'success' => 0
);

if("new" == $action) {
	$shop_info_id = $_POST["siid"];

	$model_shop_info = MySQLUtil::getShopInfo($shop_info_id);
	$shop_id = $model_shop_info->getShopId();
	$shop_name = $model_shop_info->getShopName();
	$shop_type = $model_shop_info->getShopType();

	$model_news = MySQL::getNewsMessage($shop_id);
	//检查是否存在
	//还没有存在
	if(null == $model_news) {
		$result = MySQL::saveNewsMessage($shop_id, $shop_type, $shop_name);
		if($result) {
			$msg['tips'] = "生成网站基本信息成功，补全其他信息。(刷新本页即可看到信息)";
			$msg['success'] = 1;
		}
		else {
			$msg['tips'] = "生成网站信息失败，请稍后重试";
		}
	}
	else {
		$msg['tips'] = "已存在，无需生成网站信息";
	}
}

else if("update" == $action) {
	$article_id = $_POST["nid"];
	$article_order = $_POST["order"];
	$article_title = $_POST["title"];
	$article_description = $_POST["description"];
	$shop_online = $_POST["online"];

	if("" != $article_title && "" != $article_order) {
		$result = MySQL::updNeswMessage($article_id, $shop_online, $article_order, $article_title, $article_description);
		if($result) {
			$msg['tips'] = "修改信息成功。";
			$msg['success'] = 1;
		}
		else {
			$msg['tips'] = "修改失败，请稍后重试。";
		}
	}
	else {
		$msg['tips'] = "必填字段不能为空！";
	}


}


echo json_encode($msg);