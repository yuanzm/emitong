<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>增加办卡用户</title>

	<?php include("header.php"); ?>


</head>
<body>
<div class="container">
	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>


	<div class="apply_insert_content">

		<form class="form-horizontal" role="form" method="post" action="do_apply_insert.php" enctype="multipart/form-data">

			<div class="form-group">
				<label for="user_name" class="col-sm-3 control-label">姓名 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_name" name="user_name" value="" placeholder="">
				</div>
			</div>

			<div class="form-group">
				<label for="user_room" class="col-sm-3 control-label">住址 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_room" name="user_room" value="" placeholder="">
				</div>
			</div>

			<div class="form-group">
				<label for="user_qq" class="col-sm-3 control-label">QQ <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_qq" name="user_qq" value="">
				</div>
			</div>

			<div class="form-group">
				<label for="user_phone" class="col-sm-3 control-label">手机 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_phone" name="user_phone" value="" placeholder="长号和短号，短号可不填">
				</div>
			</div>

			<div class="form-group">
				<label for="user_mom_ln" class="col-sm-3 control-label">母亲姓氏 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_mom_ln" name="user_mom_ln" value="" placeholder="">
				</div>
			</div>

			<div class="form-group">
				<label for="user_iden" class="col-sm-3 control-label">身份证 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="user_iden" name="user_iden" value="">
				</div>
			</div>

			<div class="form-group">
				<label for="user_idcard_fs" class="col-sm-3 control-label">身份证正面 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="user_idcard_fs" name="user_idcard_fs" accept="image/jpg, image/jpeg">
				</div>
			</div>

			<div class="form-group">
				<label for="user_idcard_bs" class="col-sm-3 control-label">身份证反面 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="user_idcard_bs" name="user_idcard_bs" accept="image/jpg, image/jpeg">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-7">

					<button type="submit" class="btn btn-success" id="apply_insert_submit" name="apply_insert_submit">
						<span class="glyphicon glyphicon-upload"></span> 增加
					</button>

				</div>
			</div>


		</form>
	</div>


</div>

</body>
</html>