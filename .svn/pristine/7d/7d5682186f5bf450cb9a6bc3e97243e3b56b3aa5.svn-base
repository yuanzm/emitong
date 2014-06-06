<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>查看</title>

	<?php include("header.php"); ?>
	<link rel="stylesheet" href="../../comm-lib/Datepicker-for-Bootstrap-master/datepicker.css">

	<style>
		.myTimePicker {
			display: none;
		}
		#more_update {
			display: none;
		}

	</style>
</head>
<body>
<div class="container">

	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_more_check_content">
		<?php
		require_once("Util/MySQLUtil.php");
		require_once("Util/CommonUtil.php");
		$more_id = $_GET["more_id"];
		$model_shopMore = MySQLUtil::getShopMore($more_id);
		?>

		<?php
		$more_shop_id = $model_shopMore->getShopId();
		$moreName = $model_shopMore->getMoreName();
		$moreEmiPric = $model_shopMore->getMoreEmiPrice();
		$morePrice = $model_shopMore->getMorePrice();
		$moreBeginTime = $model_shopMore->getMoreBeginTime();
		$moreEndTime = $model_shopMore->getMoreEndTime();
		$moreDescription = $model_shopMore->getMoreDescription();
		$moreImgName = $model_shopMore->getMoreImgName();
		$moreOrder = $model_shopMore->getMoreOrder();
		?>
		<!--显示每日推荐信息-->
		<form class="form-horizontal" role="form" method="post" action="do_more_update.php" enctype="multipart/form-data">

			<div class="form-group">
				<label for="more_img" class="col-sm-3 control-label">图片 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<?php
					$dir = CommonUtil::getPhotoDirPrefix("1", $more_shop_id);
					$more_img_url = CommonUtil::getPhotoUrl($dir."/".$moreImgName);
					if("" != $more_img_url):?>
						<img width="360px" src="<?=$more_img_url?>" class="img-responsive" alt="">
					<?php endif;?>
				</div>
			</div>

			<div class="form-group">
				<label for="more_name" class="col-sm-3 control-label">名称 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="more_name" name="more_name" disabled="disabled" value="<?=$moreName?>">
				</div>
			</div>

			<div class="form-group">
				<label for="more_emi_price" class="col-sm-3 control-label">益米价格 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="more_emi_price" name="more_emi_price" disabled="disabled" value="<?=$moreEmiPric?>">
				</div>
			</div>

			<div class="form-group">
				<label for="more_price" class="col-sm-3 control-label">原价 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="more_price" name="more_price" disabled="disabled" value="<?=$morePrice?>">
				</div>
			</div>

			<div class="form-group">
				<label for="begin_time" class="col-sm-3 control-label">开始时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">

					<input type="text" class="form-control" id="begin_time" name="begin_time" style="width:200px" readonly value="<?=$moreBeginTime?>">
					<a href="#" class="btn btn-primary myTimePicker" id="dp4" data-date-format="yyyy-mm-dd" data-date="<?=$moreBeginTime?>">选择时间</a>
				</div>
			</div>

			<div class="form-group">
				<label for="end_time" class="col-sm-3 control-label">结束时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">

					<input type="text" class="form-control" id="end_time" name="end_time" style="width:200px" readonly value="<?=$moreEndTime?>">
					<a href="#" class="btn btn-primary myTimePicker" id="dp5" data-date-format="yyyy-mm-dd" data-date="<?=$moreEndTime?>">选择时间</a>
				</div>
			</div>

			<div class="form-group">
				<label for="more_description" class="col-sm-3 control-label">商家描述 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<textarea type="text" class="form-control" id="more_description" name="more_description" rows="4" disabled="disabled"><?=$moreDescription?></textarea>
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-7">
					<button type="button" class="btn btn-primary"  id="more_edit" name="more_edit">
						<span class="glyphicon glyphicon-edit"></span> 编辑
					</button>
				</div>
				<div class="col-sm-offset-3 col-sm-7">
					<button type="submit" class="btn btn-primary"  id="more_update" name="more_update">
						<span class="glyphicon glyphicon-edit"></span> 提交
					</button>
				</div>
			</div>

			<div class="form-group">
				<div class="alert alert-warning col-sm-offset-3 col-sm-7" id="alert" style="display: none">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong></strong>
				</div>
			</div>

			<input type="hidden" name="more_id" value="<?=$more_id?>"/>
			<input type="hidden" name="more_img_name" value="<?=$moreImgName?>"/>
			<input type="hidden" name="more_order" value="<?=$moreOrder?>"/>
			<input type="hidden" name="more_shop_id" value="<?=$more_shop_id?>"/>
		</form>


	</div>


</div>

<script type="text/javascript" src="../../comm-lib/Datepicker-for-Bootstrap-master/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/myTimePicker.js"></script>
<script>
	$("#more_edit").click(function() {
		//$("#more_name, #more_emi_price, #more_price, #more_description").attr('disabled',false);
		$(":disabled").attr('disabled',false);
		$(".myTimePicker").show();
		$(this).hide();
		$("#more_update").show();

	})

</script>

</body>
</html>