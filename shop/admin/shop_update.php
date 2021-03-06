<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>修改资料</title>

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

	$id = $_GET["upd_id"];
	$model_shop_info = MySQLUtil::getShopInfo($id);
	$shop_id = $model_shop_info->getShopId();
	$shop_name = $model_shop_info->getShopName();
	$shop_nickname = $model_shop_info->getShopNickName();
	$shop_type = $model_shop_info->getShopType();
	$shop_address = $model_shop_info->getShopAddress();
	$shop_description = $model_shop_info->getShopDescription();

	?>
	<form class="form-horizontal" role="form">

		<div class="form-group">
			<label for="shop_id" class="col-sm-3 control-label">商家编号 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="shop_id" name="shop_id" disabled="disabled" value="<?=$shop_id?>">
			</div>
		</div>

		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">商家全称 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="name" name="name" value="<?=$shop_name?>">
			</div>
		</div>

		<div class="form-group">
			<label for="nickname" class="col-sm-3 control-label">商家简称&nbsp;&nbsp;</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="nickname" name="nickname" value="<?=$shop_nickname?>">
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
					<option
						value="<?=$type_id?>"
						<?php if ($shop_type == $type_id):?>
						selected
					    <?php endif;?>
					>
						<?php echo $type_name;?>
					</option>

					<?php endforeach;?>


				</select>
			</div>
		</div>


		<div class="form-group">
			<label for="address" class="col-sm-3 control-label">详细地址 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="address" name="address" value="<?=$shop_address?>">
			</div>
		</div>

		<div class="form-group">
			<label for="description" class="col-sm-3 control-label">商家描述 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<textarea type="text" class="form-control" id="description" name="description" rows="4"><?=$shop_description?></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-7">
				<button type="submit" class="btn btn-success"  data-loading-text="提交中.." id="upd_submit" name="upd_submit">修改</button>
			</div>
		</div>

		<div class="form-group">
			<div class="alert alert-success alert-dismissable col-sm-offset-3 col-sm-7">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>这是一个修改商家信息的页面</strong>
			</div>
		</div>
		<input type="hidden" name="id" value="<?=$id?>" id="id"/>
	</form>

</div>
<script>
	$("#upd_submit").click(function() {
		//var shop_id = $("#shop_id").val().trim();
		var id = $("#id").val().trim();
		var name = $("#name").val().trim();
		var nickname = $("#nickname").val().trim();
		var type = $("#type").val().trim();
		var address = $("#address").val().trim();
		var description = $("#description").val().trim();
		$.ajax({
			type: "post",
			url: "do_shop.php?action=upd_info",
			dataType: "json",
			data: {
				id: id,
				name: name,
				nickname: nickname,
				type: type,
				address: address,
				description: description
			},
			beforeSend: function() {
				$("#upd_submit").button("loading");
			},
			success: function(msg) {
				//location.href = "shop_photo.php";
				$("strong").text(msg.tips);
				$("#upd_submit").button('reset');
			}
		});
		return false;
	})
</script>


</body>
</html>                                                       