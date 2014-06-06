<?php session_start();?>
<?php require_once("redirect.php")?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>更多优惠</title>

	<?php include("header.php"); ?>
	<style>
		.btn-sm {
			padding: 1px 8px;
		}
		.more_oper {
			width: 90px;
		}

	</style>

</head>
<body>
<div class="container">

	<div id="nav_bar">
		<?php include("nav_bar.php");?>
	</div>

	<?php include("shop_web_menu.php");?>

	<div class="shop_more_header">
		<a href="shop_more_insert.php?sid=<?=$shop_id?>" class="btn btn-success" role="button">新增优惠</a>
	</div>
	<hr/>

	<div class="shop_more_content">
		<?php
		require_once("Util/MySQLUtil.php");
		$model_shop_more = MySQLUtil::getAllShopMore($shop_id);

		?>

		<table class="table table-striped table-hover">
			<thead>
				<tr class="table_header">
					<th>#</th>
					<th>名称</th>
					<th>益米价</th>
					<th>原价</th>
					<th>开始时间</th>
					<th>结束时间</th>
					<th>排序</th>
					<th class="more_oper">操作</th>

				</tr>
			</thead>
			<tbody>

			<?php
			//默认显示所有商户 todo 分页处理
			$num = 1;
			foreach($model_shop_more as $shop_more):?>
				<?php
				$more_id         = $shop_more->getId();
				$more_name       = $shop_more->getMoreName();
				$more_emi_price  = $shop_more->getMoreEmiPrice();
				$more_price      = $shop_more->getMorePrice();
				$more_begin_time = $shop_more->getMoreBegintime();
				$more_end_time   = $shop_more->getMoreEndTime();
				$more_order      = $shop_more->getMoreOrder();//标志是否推荐
				?>
				<tr>
					<th><?=$num++?></th>
					<th>
						<a href="shop_more_check.php?sid=<?=$shop_id?>&more_id=<?=$more_id?>"><?=$more_name?></a>
					</th>
					<th><?=$more_emi_price?></th>
					<th><?=$more_price?></th>
					<th><?=$more_begin_time?></th>
					<th><?=$more_end_time?></th>
					<th>
						<form role="role" action="do_more_common.php" method="get">
							<input type="text" style="width:40px" name="change_more_order" value="<?=$more_order?>"/>
							<button type="submit" class="btn btn-success btn-sm" title="修改排序">
								<span class="glyphicon glyphicon-sort-by-order"></span>
							</button>

							<input type="hidden" name="more_id" value="<?=$more_id?>"/>
							<input type="hidden" name="sid" value="<?=$shop_id?>"/>
							<input type="hidden" name="action" value="r"/>
						</form>
					</th>
					<th>
						<a href="do_more_common.php?more_id=<?=$more_id?>&sid=<?=$shop_id?>&action=d" class="btn btn-danger btn-sm" role="button" title="删除">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</th>
				</tr>
			<?php endforeach;?>

			</tbody>

		</table>




	</div>

</div>

</body>
</html>