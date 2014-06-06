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
		#one_update {
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

	<div class="shop_one_check_content">
		<?php
		require_once("Util/MySQLUtil.php");
		require_once("Util/CommonUtil.php");
		$one_id = $_GET["one_id"];
		$model_shopOne = MySQLUtil::getShopOne($one_id);
		?>

		<?php
		$one_shop_id = $model_shopOne->getShopId();
		$oneName = $model_shopOne->getOneName();
		$oneEmiPric = $model_shopOne->getOneEmiPrice();
		$onePrice = $model_shopOne->getOnePrice();
		$oneBeginTime = $model_shopOne->getOneBeginTime();
		$oneEndTime = $model_shopOne->getOneEndTime();
		$oneDescription = $model_shopOne->getOneDescription();
		$oneImgName = $model_shopOne->getOneImgName();
		$oneOrder = $model_shopOne->getOneOrder();
		?>
		<!--显示每日推荐信息-->
		<form class="form-horizontal" role="form" method="post" action="do_one_update.php" enctype="multipart/form-data">

			<div class="form-group">
				<label for="one_img" class="col-sm-3 control-label">图片 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<?php
					$dir = CommonUtil::getPhotoDirPrefix("0", $one_shop_id);
					$one_img_url = CommonUtil::getPhotoUrl($dir."/".$oneImgName);
					if("" != $one_img_url):?>
						<img width="360px" src="<?=$one_img_url?>" class="img-responsive" alt="">
					<?php endif;?>
				</div>
			</div>

			<div class="form-group">
				<label for="one_name" class="col-sm-3 control-label">名称 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_name" name="one_name" disabled="disabled" value="<?=$oneName?>">
				</div>
			</div>

			<div class="form-group">
				<label for="one_emi_price" class="col-sm-3 control-label">益米价格 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_emi_price" name="one_emi_price" disabled="disabled" value="<?=$oneEmiPric?>">
				</div>
			</div>

			<div class="form-group">
				<label for="one_price" class="col-sm-3 control-label">原价 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_price" name="one_price" disabled="disabled" value="<?=$onePrice?>">
				</div>
			</div>

			<div class="form-group">
				<label for="begin_time" class="col-sm-3 control-label">开始时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">

					<input type="text" class="form-control" id="begin_time" name="begin_time" style="width:200px" readonly value="<?=$oneBeginTime?>">
					<a href="#" class="btn btn-primary myTimePicker" id="dp4" data-date-format="yyyy-mm-dd" data-date="<?=$oneBeginTime?>">选择时间</a>
				</div>
			</div>

			<div class="form-group">
				<label for="end_time" class="col-sm-3 control-label">结束时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">

					<input type="text" class="form-control" id="end_time" name="end_time" style="width:200px" readonly value="<?=$oneEndTime?>">
					<a href="#" class="btn btn-primary myTimePicker" id="dp5" data-date-format="yyyy-mm-dd" data-date="<?=$oneEndTime?>">选择时间</a>
				</div>
			</div>

			<div class="form-group">
				<label for="one_description" class="col-sm-3 control-label">商家描述 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<textarea type="text" class="form-control" id="one_description" name="one_description" rows="4" disabled="disabled"><?=$oneDescription?></textarea>
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-7">
					<button type="button" class="btn btn-primary"  id="one_edit" name="one_edit">
						<span class="glyphicon glyphicon-edit"></span> 编辑
					</button>
				</div>
				<div class="col-sm-offset-3 col-sm-7">
					<button type="submit" class="btn btn-primary"  id="one_update" name="one_update">
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

			<input type="hidden" name="one_id" value="<?=$one_id?>"/>
			<input type="hidden" name="one_img_name" value="<?=$oneImgName?>"/>
			<input type="hidden" name="one_order" value="<?=$oneOrder?>"/>
			<input type="hidden" name="one_shop_id" value="<?=$one_shop_id?>"/>
		</form>


	</div>


</div>

<script type="text/javascript" src="../../comm-lib/Datepicker-for-Bootstrap-master/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/myTimePicker.js"></script>
<script>
	$("#one_edit").click(function() {
		//$("#one_name, #one_emi_price, #one_price, #one_description").attr('disabled',false);
		$(":disabled").attr('disabled',false);
		$(".myTimePicker").show();
		$(this).hide();
		$("#one_update").show();

	})

</script>

</body>
</html>