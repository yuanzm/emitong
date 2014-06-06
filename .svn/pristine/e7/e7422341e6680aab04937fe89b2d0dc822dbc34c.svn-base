<?php
//--------------local--------------
/**
 * local test START
 */
//header('Content-Type:text/html; charset=UTF-8');

//$host = "localhost";
//$name = "root";
//$pass = "";
//$dbname = "app_zcxwz";
//
//$hd=mysql_connect($server,$name,$pass) or die("抱歉，无法连接");
//$db=mysql_select_db($dbname,$hd);
//mysql_query('SET names utf8');
////线上使用post
//$index = $_GET["index"];
//$amount = $_GET["amount"];
//$sql = "select * from cb_menu order by cb_id limit $index,$amount ";
//$res = mysql_query($sql);
//while($re = mysql_fetch_array($res)) {
//	$userList[] = array(
//		'imgPath'		=>$re['cb_id'],
//		'foodname'		=>$re['cb_name'],
//		'currentPrice'	=>$re['cb_price'],
//		'oldPrice'		=>$re['cb_price']
//		);
//}
//
//echo json_encode($userList);
/**
 * local test END
 */

//-------------online---------------

/**
 * online START
 */

//定义emitong文件夹路径
if(!defined('EMITONG_DIR')) {
	define('EMITONG_DIR', dirname(dirname(__FILE__)) );
}
//定义shop文件夹路径
if(!defined('SHOP_DIR')) {
	define('SHOP_DIR', dirname(dirname(dirname(__FILE__))));
}
//引用Util包
require_once(SHOP_DIR."/admin/Util/CommonUtil.php");
require_once(SHOP_DIR."/admin/Util/MyBCSUtil.php");

$index  = $_POST["index"];
$amount = $_POST["amount"];
$action = $_GET["action"];

if("" != $index && "" != $amount) {

	if("more" == $action) {
		$shop_id = $_POST["sid"];
		require_once(EMITONG_DIR."/Util/ShopMySQL.php");
		//获取更多的列表
		$model_all_shop_more = ShopMySQL::getAllShopMore($shop_id, $index, $amount);
		if(0 != count($model_all_shop_more)) {
			foreach($model_all_shop_more as $model_shop_more){
				//基本字段
				$more_name      = $model_shop_more->getMoreName();
				$more_emi_price = $model_shop_more->getMoreEmiPrice();
				$more_price     = $model_shop_more->getMorePrice();
				$more_img_name  = $model_shop_more->getMoreImgName();
				//图片
				$prefix             = CommonUtil::getPhotoDirPrefix("1", $shop_id);
				$more_img_url        = CommonUtil::getPhotoUrl($prefix."/".$more_img_name);

				//写入返回的数组
				$moreList[] = array(
					'imgPath'		=> $more_img_url,
					'foodname'		=> $more_name,
					'currentPrice'	=> $more_emi_price,
					'oldPrice'		=> $more_price,
					'mid'           => $more_id
				);
			}
			echo json_encode($moreList);
		}
		else {
			//到底了
			echo "0";
		}

	}
	else if("shop" == $action){
		$type = $_POST["type"];
		require_once(EMITONG_DIR."/Util/WXMySQL.php");
		//获取商家列表
		$model_all_shop_news = WXMySQL::getShopListByType($type, $index, $amount);
		if(0 != count($model_all_shop_news)) {
			foreach($model_all_shop_news as $model_shop_new){
				//基本字段
				$shop_id            = $model_shop_new->getShopId();
				$article_title      = $model_shop_new->getArticleTitle();
				$article_img_name   = $model_shop_new->getArticleImgName();
				//图片url
				$prefix             = CommonUtil::getPhotoDirPrefix("3", $shop_id);
				$article_img_url    = CommonUtil::getPhotoUrl($prefix."/".$article_img_name);
				//写入返回的数组
				$shopList[] = array(
					'articleImgPath'=> $article_img_url,
					'articleTitile'	=> $article_title,
					'sid'           => $shop_id
				);
			}
			echo json_encode($shopList);
		}
		else {
			//到底了
			echo "0";
		}
	}
	else {
		//返回0
		echo "0";
	}
}

