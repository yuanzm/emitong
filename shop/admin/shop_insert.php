<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>增加商家</title>

	<?php include("header.php"); ?>


</head>
<body>
	<div class="container">
		<div id="nav_bar">
			<?php include("nav_bar.php");?>
		</div>
		<?php
		require_once("Util/MySQLUtil.php");
		$model_all_shop_type = MySQLUtil::getAllShopType();
		?>

		<form class="form-horizontal" role="form">

			<div class="form-group">
				<label for="shop_id" class="col-sm-3 control-label">商家编号 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="shop_id" name="shop_id" disabled="disabled" value="自动生成，无需填写">
				</div>
			</div>

			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">商家全称 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="name" name="name" placeholder="必填项">
				</div>
			</div>

			<div class="form-group">
				<label for="nickname" class="col-sm-3 control-label">商家简称&nbsp;&nbsp;</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="nickname" name="nickname" placeholder="可不填">
				</div>
			</div>

			<div class="form-group">
				<label for="type" class="col-sm-3 control-label">商家类型 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<select class="form-control" name="type" id="type">
						<option value="">请选择...</option>
						<?php foreach ($model_all_shop_type as $model_shop_type ): ?>
						<?php
						$type_id = $model_shop_type->getId();
						$type_name = $model_shop_type->getTypeName();
						?>
						<option value="<?=$type_id?>">
							<?=$type_name?>
						</option>
						<?php endforeach;?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label for="address" class="col-sm-3 control-label">详细地址 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="address" name="address" placeholder="必填项">
				</div>
			</div>

			<div class="form-group">
				<label for="description" class="col-sm-3 control-label">商家描述 <span class="text-muted">*</span></label>
				<div class="col-sm-7">
					<textarea type="text" class="form-control" id="description" name="description" rows="4" placeholder="200字以内.."></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-7">
					<button type="submit" class="btn btn-default"  data-loading-text="提交中.." id="add_submit" name="add_submit">增加</button>
				</div>
			</div>

			<div class="form-group">
				<div class="alert alert-info alert-dismissable col-sm-offset-3 col-sm-7">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Hi</strong>
				</div>
			</div>
		</form>


	</div>

	<script>
		$("#add_submit").click(function() {
			//var shop_id = $("#shop_id").val().trim();
			var name = $("#name").val().trim();
			var nickname = $("#nickname").val().trim();
			var type = $("#type").val().trim();
			var address = $("#address").val().trim();
			var description = $("#description").val().trim();
			$.ajax({
				type: "post",
				url: "do_shop.php?action=add_info",
				dataType: "json",
				data: {
					name: name,
					nickname: nickname,
					type: type,
					address: address,
					description: description
				},
				beforeSend: function() {
					$("#add_submit").button("loading");
				},
				success: function(msg) {
					$("strong").text(msg.tips);
					$("#add_submit").button('reset');
				}
			});
			return false;
		})
	</script>


</body>
</html>