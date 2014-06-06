<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

/**
 * Description:
 *
 * Author: Yip
 * Date: 14-3-26 上午9:09
 */

if( "" != $_SESSION["flag"] && "" != $_SESSION["username"])
{
	session_unset();
	session_destroy();
	echo "<script type='text/javascript'>location.href='login.php';</script>";
}
else {
	echo "<script type='text/javascript'>alert('请先登录！');location.href='login.php';</script>";
}