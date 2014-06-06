<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>商家后院</title>

	<?php include("header.php"); ?>
	<style>
		/*.shop_home_content .panel-heading {padding :0;}*/
		/*.shop_home_content .panel-heading img {width:100%;}*/

	</style>

</head>
<body>
<div class="container">

	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_home_header">
		<a href="shop_home_insert.php?sid=<?=$shop_id?>" class="btn btn-info" role="button">新增照片</a>
	</div>
	<hr/>

	<?php
	require_once("Util/MySQLUtil.php");
	require_once("Util/CommonUtil.php");
	$model_all_shop_home = MySQLUtil::getAllShopHome($shop_id);
	?>
	<div class="shop_home_content">
	<?php if(null != $model_all_shop_home): ?>

		<div class="row">
			<?php foreach($model_all_shop_home as $model_shop_home):?>
				<div class="col-sm-6 col-md-4">

					<div class="thumbnail">
						<?php
						$home_id = $model_shop_home->getId();
						$home_img_name = $model_shop_home->getHomeImgName();

						$dir = CommonUtil::getPhotoDirPrefix("2", $shop_id);
						$home_img_url = CommonUtil::getPhotoUrl($dir."/".$home_img_name);
						if("" != $home_img_url){
							$url = $home_img_url;
						}
						else {
							//填写默认图片url
							$url = "";
						}
						?>
						<img src="<?=$url?>" alt="">

						<div class="caption">
							<a href="do_home_common.php?hid=<?=$home_id?>&sid=<?=$shop_id?>&action=d" class="btn btn-danger" role="button" title="删除">
								<span class="glyphicon glyphicon-trash"></span> 删除
							</a>
						</div>

					</div>

				</div>

			<?php endforeach;?>

		</div>
	<?php else:?>
		<div class="well">
			<p>暂无商家后院图片，请点击“新增照片”开始上传。</p>
		</div>
	<?php endif;?>

	</div>


</div>