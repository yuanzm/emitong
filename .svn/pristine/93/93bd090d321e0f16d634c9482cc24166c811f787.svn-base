<?php session_start(); ?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>登录</title>

	<?php include("header.php"); ?>

	<link rel="stylesheet" href="css/login.css"/>

</head>
<body>
	<div class="container">

		<div class="form-signin" role="form">
			<h2 class="form-signin-heading">Please sign in</h2>
			<input type="text" class="form-control admin_name" name="admin_name" placeholder="Username" required autofocus>
			<input type="password" class="form-control admin_pwd" name="admin_pwd" placeholder="Password" required>

			<button id="login" class="btn btn-lg btn-primary btn-block" data-loading-text="login..." type="submit" name="admin_submit">Sign in</button>

			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Welcome, nice to meet you!</strong>
			</div>

		</div>

	</div>


	<script>
		$("#login").click(function() {
			var name = $(".admin_name").val().trim();
			var pwd = $(".admin_pwd").val().trim();

			$.ajax({
				type: "post",
				url: "do_login.php",
				dataType: "json",
				data: {name: name, pwd: pwd},
				beforeSend: function() {
					$("#login").button('loading');
				},
				success: function(msg) {
					if (1 == msg.success) {
						location.href = "index.php";
					}
					else {
						$("strong").text(msg.tips);
						$("#login").button('reset');
					}
				}
			});
			return false;
		});

	</script>




</body>
</html>