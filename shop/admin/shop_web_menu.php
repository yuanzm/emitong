<?php
//多处使用，谨慎修改
$shop_id = $_GET["sid"];
$shop_info_id = $_GET["siid"];
?>

<div>
	<a href="shop_web.php?sid=<?=$shop_id?>&siid=<?=$shop_info_id?>" class="btn btn-warning btn-lg" id="shop_web" name="shop_web">
		<span class="glyphicon glyphicon-wrench"></span> 网站配置
	</a>
	<a href="shop_one.php?sid=<?=$shop_id?>&siid=<?=$shop_info_id?>" class="btn btn-primary btn-lg" id="shop_one" name="shop_one">
		<span class="glyphicon glyphicon-star"></span> 每日推荐
	</a>
	<a href="shop_more.php?sid=<?=$shop_id?>&siid=<?=$shop_info_id?>" class="btn btn-success btn-lg" id="shop_more" name="shop_more">
		<span class="glyphicon glyphicon-gift"></span> 更多优惠
	</a>
	<a href="shop_home.php?sid=<?=$shop_id?>&siid=<?=$shop_info_id?>" class="btn btn-info btn-lg" id="shop_home" name="shop_home">
		<span class="glyphicon glyphicon-home"></span> 商家后院
	</a>
</div>

<hr/>