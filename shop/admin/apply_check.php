<?php session_start();?>
<?php require_once("redirect.php")?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>办卡资料</title>

	<?php include("header.php"); ?>


</head>
<body>
<div class="container">

	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>
	<?php
	require_once("wechat/Util/MySQL.php");
	require_once("wechat/Util/WXCommUtil.php");

	$id = $_GET["id"];
	$model_apply_user = MySQL::getApplyUser($id);
	//$open_id = $model_apply_user->getOpenId();
	$user_id = $model_apply_user->getUserId();
	$user_name = $model_apply_user->getUserName();
	$user_room = $model_apply_user->getUserRoom();
	$user_qq = $model_apply_user->getUserQQ();
	$user_phone = $model_apply_user->getUserPhone();
	$user_mom_ln = $model_apply_user->getUserMomLn();
	$user_iden = $model_apply_user->getUserIden();
	$id_card_fs = $model_apply_user->getIdCardFs();
	$id_card_bs = $model_apply_user->getIdCardBs();

	$fs_url = WXCommUtil::getIdCardUrl($user_id,$id_card_fs);
	$bs_url = WXCommUtil::getIdCardUrl($user_id,$id_card_bs);
	?>

	<?php
	$model_apply_status = MySQL::getApplyStatus($user_id);
	$status_id = $model_apply_status->getId();
	$status_status = $_GET["status"];
	?>

	<form class="form-horizontal" method="post" action="do_apply_update.php" role="form">

		<div class="form-group">
			<label for="user_name" class="col-sm-3 control-label">姓名 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_name" name="user_name" value="<?=$user_name?>">
			</div>
		</div>

		<div class="form-group">
			<label for="user_room" class="col-sm-3 control-label">宿舍 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_room" name="user_room" value="<?=$user_room?>">
			</div>
		</div>

		<div class="form-group">
			<label for="user_qq" class="col-sm-3 control-label">QQ <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_qq" name="user_qq" value="<?=$user_qq?>">
			</div>
		</div>

		<div class="form-group">
			<label for="user_phone" class="col-sm-3 control-label">手机 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_phone" name="user_phone" value="<?=$user_phone?>">
			</div>
		</div>


		<div class="form-group">
			<label for="user_mom_ln" class="col-sm-3 control-label">母亲姓氏 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_mom_ln" name="user_mom_ln" value="<?=$user_mom_ln?>">
			</div>
		</div>

		<div class="form-group">
			<label for="user_iden" class="col-sm-3 control-label">身份证 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="user_iden" name="user_iden" value="<?=$user_iden?>">
			</div>
		</div>

		<div class="form-group">
			<label for="id_card_fs" class="col-sm-3 control-label">身份证正面 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<?php if("" != $fs_url):?>
				<img width="360px" src="<?=$fs_url?>" class="img-responsive" alt="正面">
				<?php endif;?>
			</div>
		</div>


		<div class="form-group">
			<label for="id_card_bs" class="col-sm-3 control-label">身份证反面 <span class="text-muted">*</span></label>
			<div class="col-sm-7">
				<?php if("" != $bs_url):?>
				<img width="360px" src="<?=$bs_url?>" class="img-responsive" alt="反面">
				<?php endif;?>
			</div>
		</div>

		<div class="form-group">
			<div class="status_btn col-sm-offset-3 col-sm-7">
				<button type="submit" class="btn btn-success"  data-loading-text="处理中.." id="pass_submit" name="pass_submit">
					<span class="glyphicon glyphicon-ok"></span> 通过
				</button>
				<button type="submit" class="btn btn-danger"  data-loading-text="处理中.." id="unpass_submit" name="unpass_submit">
					<span class="glyphicon glyphicon-remove"></span> 失败
				</button>
				<button type="submit" class="btn btn-primary"  data-loading-text="处理中.." id="done_submit" name="done_submit">
					<span class="glyphicon glyphicon-check"></span> 发卡
				</button>
				<button type="submit" class="btn btn-warning"  data-loading-text="处理中.." id="checking_submit" name="checking_submit">
					<span class="glyphicon glyphicon-question-sign"></span> 待审
				</button>
				<a href="do_apply_delete.php?auid=<?=$id?>&asid=<?=$status_id?>" class="btn btn-default" id="apply_delete" name="apply_delete">删除</a>
			</div>
		</div>

		<div class="form-group">
			<div class="update_btn col-sm-offset-3 col-sm-7">
				<button type="submit" class="btn btn-info" id="checking_submit" name="update_submit">
					<span class="glyphicon glyphicon-pencil"></span> 修改资料
				</button>
			</div>
		</div>

		<input type="hidden" name="status_id" value="<?=$status_id?>" id="status_id"/>
		<input type="hidden" name="auid" value="<?=$id?>"/>
	</form>

</div>

<script>
	$("#pass_submit").click(function() {
		var status_id = $("#status_id").val().trim();
		$.ajax({
			type: "post",
			url: "do_apply.php?action=pass",
			dataType: "json",
			data: {
				status_id: status_id
			},
			beforeSend: function() {
				$(".status_btn > button").button("loading");
			},
			success: function(msg) {
				$("strong").text(msg.tips);
				$(".status_btn > button").button("reset");
			}
		});
		return false;
	});

	$("#unpass_submit").click(function() {
		var status_id = $("#status_id").val().trim();
		$.ajax({
			type: "post",
			url: "do_apply.php?action=unpass",
			dataType: "json",
			data: {
				status_id: status_id
			},
			beforeSend: function() {
				$(".status_btn > button").button("loading");
			},
			success: function(msg) {
				$("strong").text(msg.tips);
				$(".status_btn > button").button("reset");
			}
		});
		return false;
	});

	$("#done_submit").click(function() {
		var status_id = $("#status_id").val().trim();
		$.ajax({
			type: "post",
			url: "do_apply.php?action=done",
			dataType: "json",
			data: {
				status_id: status_id
			},
			beforeSend: function() {
				$(".status_btn > button").button("loading");
			},
			success: function(msg) {
				$("strong").text(msg.tips);
				$(".status_btn > button").button("reset");
			}
		});
		return false;
	});

	$("#checking_submit").click(function() {
		var status_id = $("#status_id").val().trim();
		$.ajax({
			type: "post",
			url: "do_apply.php?action=checking",
			dataType: "json",
			data: {
				status_id: status_id
			},
			beforeSend: function() {
				$(".status_btn > button").button("loading");
			},
			success: function(msg) {
				$("strong").text(msg.tips);
				$(".status_btn > button").button("reset");
			}
		});
		return false;
	})


</script>


</body>
</html>