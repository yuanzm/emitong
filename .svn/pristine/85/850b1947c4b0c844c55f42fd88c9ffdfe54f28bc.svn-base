<?php
// $shop_id="2_1398397253_34";
$shop_id = $_GET["sid"];
if("" != $shop_id):
	?>
<?php
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
require_once(EMITONG_DIR."/Util/ShopMySQL.php");

$model_shop_one     = ShopMySQL::getShopOne($shop_id);
	//基本字段
$one_name           = $model_shop_one->getOneName();
$one_emi_price      = $model_shop_one->getOneEmiPrice();
$one_price          = $model_shop_one->getOnePrice();
$one_description    = $model_shop_one->getOneDescription();
$one_img_name       = $model_shop_one->getOneImgName();
	//图片
$prefix             = CommonUtil::getPhotoDirPrefix("0", $shop_id);
$one_img_url        = CommonUtil::getPhotoUrl($prefix."/".$one_img_name);
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head lang="zh">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no ">
	<title>益米推荐</title>
	<link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/home.css">
	<link rel="stylesheet" type="text/css" href="../static/css/nav-footer.css">
</head>
<body>
	<div class="container">
		<div id="main-content">
			<div class="store-picture">
				<img src="<?=$one_img_url?>" alt="food-menu" class="food-menu">
			</div>
			<div id="food-name">
				<span>【<?=$one_name?>】</span>
			</div>
			<div id="labels">
				<div class="label-info">
					<span id = "label1">益米价</span>
					<span class = "

					<?php if(0 == $one_emi_price):?>
						orginal-price
					<?php else:?>
						currentprice
					<?php endif;?>
					">￥<?=$one_emi_price?>元</span>
					<span class = "orginal-price">￥<?=$one_price?>元</span>
				</div>
				<div id="store-content">
					<p><?=$one_description?></p>
				</div>
			</div>
		</div>
		<div id="footer">	
			<ul class="navbar-fixed-bottom">
				<a href="index.php?sid=<?=$shop_id?>" ><li class="link1"><img src="../static/images/house.png" class = "button-img3">商家后院</li></a>
				<a href="emirecommend.php?sid=<?=$shop_id?>"><li class="link link2"><img src="../static/images/star.png" class="button-img1">益米推荐</li></a>
				<a href="preferential.php?sid=<?=$shop_id?>"><li class="link link3"><img src="../static/images/gift.png" class="button-img2" >更多优惠</li></a>
			</ul>
		</div>
	</div>
</body>
<script type="text/javascript" src="../static/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../static/js/nav-footer.js"></script>
</html>
<?php endif;?>