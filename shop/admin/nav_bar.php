<?php $username = $_SESSION["username"];?>
<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">LOGO</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">

			<li><a href="index.php">首页</a></li>

			<li><a href="shop_info.php" >商家信息</a></li>

			<li><a href="apply_user.php" >办卡管理</a></li>


		</ul>


		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 你好
					<span class="label label-primary"><?=$username?></span><b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">我的资料</a></li>
					<li><a href="#">系统信息</a></li>
					<li class="divider"></li>
					<li>
						<a href="logout.php">登出</a>
					</li>

				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>