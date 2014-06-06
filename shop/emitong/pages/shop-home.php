<?php
//$shop_id="2_1398397253_34";
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

	$model_all_shop_home    = ShopMySQL::getAllShopHome($shop_id);
	$model_shop_info        = ShopMySQL::getShopInfo($shop_id);
	$shop_name              = $model_shop_info->getShopName();
	$shop_description       = $model_shop_info->getShopDescription();
	?>
<!DOCTYPE html>
<html>
<head lang="zh">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no ">
	<title>商家主页</title>
	<link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/shop_home.css">
	<link rel="stylesheet" type="text/css" href="../static/css/nav-footer.css">
</head>
<body>
	<div class="container">
		<div id="main-content">
			<div class="store-picture">
				<!-- <img src="../static/images/pic01.jpg" alt="food-menu" class="food-menu"> -->
				<div id="index_carousrl">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php for($i=0; $i<count($model_all_shop_home); $i++):?>

								<?php if(0 == $i):?>

									<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="active"></li>

								<?php else:?>

									<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>"></li>

								<?php endif;?>

							<?php endfor;?>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
						<?php foreach($model_all_shop_home as $key => $model_shop_home):?>
							<?php
							$home_img_name = $model_shop_home->getHomeImgName();
							//图片url
							$prefix        = CommonUtil::getPhotoDirPrefix("2", $shop_id);
							$home_img_url  = CommonUtil::getPhotoUrl($prefix."/".$home_img_name);
							?>
							<?php if("" != $home_img_url):?>

								<?php if(0 != $key):?>

								<div class="item">
									<img src="<?=$home_img_url?>" alt="">
									<div class="carousel-caption">
									</div>
								</div>

								<?php else:?>

									<div class="item active">
										<img src="<?=$home_img_url?>" alt="">
										<div class="carousel-caption">
										</div>
									</div>

								<?php endif;?>

							<?php endif;?>

						<?php endforeach;?>

						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
				</div>
			</div>
			<div id="food-name">
				<span>【<?=$shop_name?>】</span>
			</div>
			<div id="labels">
				<div id="store-content">
					<p><?=$shop_description?></p>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">	
		<ul class="navbar-fixed-bottom">
			<a href="index.php?sid=<?=$shop_id?>"><li class="link1"><img src="../static/images/star.png" class="button-img1">益米优惠</li></a>
			<a href="preferential.php?sid=<?=$shop_id?>"><li class="link link2"><img src="../static/images/gift.png" class="button-img2" >更多优惠</li></a>
			<a href="shop-home.php?sid=<?=$shop_id?>" ><li class="link link3"><img src="../static/images/house.png" class = "button-img3">商家后院</li></a>
		</ul>
	</div>
</div>
</div>
</body>
<script type="text/javascript" src="../static/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="../static/js/nav-footer.js"></script>
</html>
<?php endif;?>