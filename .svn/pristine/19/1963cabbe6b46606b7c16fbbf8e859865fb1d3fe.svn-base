<!doctype html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>导出</title>
</head>
<body>
<form action="" method="post">
	<input type="submit" name="submit" value="开始"/>
</form>



</body>
</html>


<?php

if(isset($_POST["submit"])){
	//连接数据库
	$server='localhost';  //mysql服务器地址
	$user='root';         //登陆mysql的用户名
	$pass='';          //登陆mysql的密码
	$db_name='emi_wechat';   //mysql中要操作的数据库名
	$hd=mysql_connect($server,$user,$pass) or die("抱歉，无法连接");
	$db=mysql_select_db($db_name,$hd);
	mysql_query('SET names utf8');

	$sql1 = "select * from old_apply_user";
	$resource = mysql_query($sql1);

	while($re = mysql_fetch_array($resource)){
		$user_id = $re["user_id"];

		$sql2 = "insert into apply_status (user_id, status, download) values ($user_id, 0, 1)";
		mysql_query($sql2);
		echo $re["user_name"]."成功";
	}
}
?>