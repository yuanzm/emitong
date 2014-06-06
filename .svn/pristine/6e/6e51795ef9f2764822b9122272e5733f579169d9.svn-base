<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>每日推荐</title>

	<?php include("header.php"); ?>
	<style>
		.btn-sm {
			padding: 1px 8px;
		}

	</style>

</head>
<body>
<div class="container">

	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_one_header">
		<a href="shop_one_insert.php?sid=<?=$shop_id?>" class="btn btn-primary" role="button">添加推荐</a>
	</div>
	<hr/>

	<div class="shop_one_content">

	<?php
	require_once("Util/MySQLUtil.php");
	$model_shop_one = MySQLUtil::getAllShopOne($shop_id);

	?>
		<form role="form">
			<table class="table table-striped table-hover">
				<thead>
				<tr class="table_header">
					<th>#</th>
					<th>名称</th>
					<th>益米价</th>
					<th>原价</th>
					<th>开始时间</th>
					<th>结束时间</th>
					<th>推荐状态</th>
					<th>操作</th>

				</tr>
				</thead>
				<tbody>

				<?php
				//默认显示所有商户 todo 分页处理
				$num = 1;
				foreach($model_shop_one as $shop_one):?>
					<?php
					$one_id         = $shop_one->getId();
					$one_name       = $shop_one->getOneName();
					$one_emi_price  = $shop_one->getOneEmiPrice();
					$one_price      = $shop_one->getOnePrice();
					$one_begin_time = $shop_one->getOneBegintime();
					$one_end_time   = $shop_one->getOneEndTime();
					$one_order      = $shop_one->getOneOrder();//标志是否推荐
					?>
					<tr>
						<th><?=$num++?></th>
						<th>
							<a href="shop_one_check.php?sid=<?=$shop_id?>&one_id=<?=$one_id?>"><?=$one_name?></a>
						</th>
						<th><?=$one_emi_price?></th>
						<th><?=$one_price?></th>
						<th><?=$one_begin_time?></th>
						<th><?=$one_end_time?></th>
						<th>
							<?php if(1 == $one_order):?>

								<span class="glyphicon glyphicon-thumbs-up" title="已推荐"></span>
								<?php $change_icon_class = "glyphicon glyphicon-thumbs-down";$chang_title = "取消推荐"?>

							<?php else:?>

								<span class="glyphicon glyphicon-thumbs-down" title="未推荐"></span>
								<?php $change_icon_class = "glyphicon glyphicon-thumbs-up";$chang_title = "推荐"?>

							<?php endif;?>


						</th>
						<th>
							<a href="do_one_common.php?one_id=<?=$one_id?>&sid=<?=$shop_id?>&action=r" class="btn btn-primary btn-sm" role="button" title="<?=$chang_title?>">
								<span class="<?=$change_icon_class?>"></span>
							</a>&nbsp;|&nbsp;

							<a href="do_one_common.php?one_id=<?=$one_id?>&sid=<?=$shop_id?>&action=d" class="btn btn-danger btn-sm" role="button" title="删除">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</th>
					</tr>
				<?php endforeach;?>

				</tbody>

			</table>


		</form>

	</div>

</div>

</body>
</html>