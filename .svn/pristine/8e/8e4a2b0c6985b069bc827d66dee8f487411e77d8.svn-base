<?php
//$type=1;
$type=$_GET["type"];
if( "" != $type):
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
	require_once(EMITONG_DIR."/Util/WXMySQL.php");

	$model_all_shop_news = WXMySQL::getShopListByType($type);
	?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no ">
	<title>商家栏</title>
	<link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/store-links.css">
</head>
<body>
	<div class="container">
		<div id="more-preferential">
			<div class="preferential-list">
<!--				循环开始-->
				<?php foreach($model_all_shop_news as $model_shop_new):?>
					<?php
					//基本字段
					$shop_id            = $model_shop_new->getShopId();
					$article_title      = $model_shop_new->getArticleTitle();
					$article_img_name   = $model_shop_new->getArticleImgName();
					//图片url
					$prefix             = CommonUtil::getPhotoDirPrefix("3", $shop_id);
					$article_img_url    = CommonUtil::getPhotoUrl($prefix."/".$article_img_name);
					?>
				<div class="preferential-pic">
					<img src="<?=$article_img_url?>" alt="<?=$article_title?>" class="pre-picture">
					<div class="preferential-info">
						<span class = "product-name"><?=$article_title?></span>
					</div>
					<div class = "link-pic">
						<a href="index.php?sid=<?=$shop_id?>" class="links"><img src="../static/images/links.png"></a>
					</div>
				</div>
				<?php endforeach;?>
<!--					循环结束-->
			</div>
		</div>
		<div id="add-load">
			<a href="#" id="more_shop">点击加载更多</a>
		</div>
		<input type="hidden" value="<?=$type?>" id="type"/>
	</div>
</body>
<script type="text/javascript" src="../static/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../static/js/store-links.js"></script>
</html>
<?php endif;?>