<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>增加每日推荐</title>

	<?php include("header.php"); ?>
	<link rel="stylesheet" href="../../comm-lib/Datepicker-for-Bootstrap-master/datepicker.css">


</head>
<body>
<div class="container">
	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_one_insert_content">

		<form class="form-horizontal" role="form" method="post" action="do_one_insert.php" enctype="multipart/form-data">

			<div class="form-group">
				<label for="one_name" class="col-sm-3 control-label">名称 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_name" name="one_name" value="" placeholder="10个字以内">
				</div>
			</div>

			<div class="form-group">
				<label for="one_emi_price" class="col-sm-3 control-label">益米价 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_emi_price" name="one_emi_price" value="" placeholder="由数字和小数点组成">
				</div>
			</div>

			<div class="form-group">
				<label for="one_price" class="col-sm-3 control-label">原价 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="one_price" name="one_price" value="" placeholder="由数字和小数点组成">
				</div>
			</div>

			<div class="form-group">
				<label for="begin_time" class="col-sm-3 control-label">开始时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">
					<?php $default_begin_time = date("Y-m-d");?>

					<input type="text" class="form-control" id="begin_time" name="begin_time" value="<?=$default_begin_time?>" style="width: 200px" readonly>
					<a href="#" class="btn btn-default" id="dp4" data-date-format="yyyy-mm-dd" data-date="<?=$default_begin_time?>">选择时间</a>
				</div>
			</div>


			<div class="form-group">
				<label for="end_time" class="col-sm-3 control-label">结束时间 <span class="text-muted">*</span></label>
				<div class="col-sm-7 form-inline">
					<?php $default_end_time = date("Y-m-d",strtotime("+5 days"));?>

					<input type="text" class="form-control" id="end_time" name="end_time" value="<?=$default_end_time?>" style="width: 200px" readonly>
					<a href="#" class="btn btn-default" id="dp5" data-date-format="yyyy-mm-dd" data-date="<?=$default_end_time?>">选择时间</a>
				</div>
			</div>

			<div class="form-group">
				<label for="one_description" class="col-sm-3 control-label">商家描述 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<textarea type="text" class="form-control" id="one_description" name="one_description" rows="4" maxlength=120 placeholder="请不要超过120个字"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="one_img" class="col-sm-3 control-label">图片 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="one_img" name="one_img" accept="image/jpg, image/jpeg">
				</div>
			</div>

			<div class="form-group">
				<div class="one_btn col-sm-offset-3 col-sm-7">

					<button type="submit" class="btn btn-primary"  data-loading-text="提交中.." id="one_new_submit" name="one_new_submit">
						<span class="glyphicon glyphicon-upload"></span> 提交
					</button>

				</div>
			</div>

			<div class="form-group">
				<div class="alert alert-warning col-sm-offset-3 col-sm-7" id="alert" style="display: none">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Hi</strong>
				</div>
			</div>

			<input type="hidden" name="shop_id" value="<?=$shop_id?>"/>

		</form>
	</div>


</div>

<script type="text/javascript" src="../../comm-lib/Datepicker-for-Bootstrap-master/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/myTimePicker.js">

</script>


</body>
</html>