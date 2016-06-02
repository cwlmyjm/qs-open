<!doctype html>
<html>
	<head>
		<title>F55寝室账单系统</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<link rel="stylesheet" type="text/css" href="global.css" />
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<p>F55寝室账单系统</p>
		<hr />
		<?php
		include "function.php";
		if (check_login(connection())){
			include "show.php";
		}
		else{
			include "login.php";
		}
		?>
	</body>
</html>