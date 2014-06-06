<?php session_start(); ?>
<?php require_once("redirect.php")?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>首页</title>

	<?php include("header.php"); ?>

</head>
<body>
	<div class="container">

		<div id="nav_bar">
			<?php include("nav_bar.php");?>
		</div>

		<div id="index_jumbotron">
			<?php include("index_jumbotron.php");?>;
		</div>




	</div>
</body>
</html>