<?php
if (null == $_SESSION["flag"] || "" == $_SESSION["flag"])
	echo "<script type='text/javascript'>location.href='login.php';</script>";
?>