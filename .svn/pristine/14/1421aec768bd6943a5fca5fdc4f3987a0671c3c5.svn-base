<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>增加后院图片</title>

	<?php include("header.php"); ?>


</head>
<body>
<div class="container">
	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_home_insert_content">

		<form class="form-horizontal" role="form" method="post" action="do_home_insert.php" enctype="multipart/form-data">

			<div class="form-group">
				<label for="home_img" class="col-sm-3 control-label">图片 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="home_img" name="home_img" accept="image/jpg, image/jpeg">
				</div>
			</div>

			<div class="form-group">
				<div class="home_btn col-sm-offset-3 col-sm-7">

					<button type="submit" class="btn btn-info"  data-loading-text="提交中.." id="home_new_submit" name="home_new_submit">
						<span class="glyphicon glyphicon-upload"></span> 提交
					</button>

				</div>
			</div>

			<div class="form-group">
				<div class="alert alert-info col-sm-offset-3 col-sm-7" id="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>请注意图片尺寸为：宽360px * 高200px</strong>
				</div>
			</div>

			<input type="hidden" name="shop_id" value="<?=$shop_id?>"/>

		</form>
	</div>


</div>

</body>
</html>