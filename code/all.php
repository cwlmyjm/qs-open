<!doctype html>
<html>
	<head>
		<title>总的支出记录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<link rel="stylesheet" type="text/css" href="global.css" />
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
	<p>总的支出记录</p>
	<?php
	include "function.php";
	ensure_login();
	$result = get_all_expenditure(connection());
	echo "<table>";
	echo "<tr>";
		echo "<th>支出序号</th>";
		echo "<th>支出者</th>";
		echo "<th>支出详细</th>";
		echo "<th>支出金额</th>";
		echo "<th>支出时间</th>";
	echo "</tr>";
	for ($i = mysql_num_rows($result)-1;$i >=0;$i--){
		echo "<tr>";
			echo "<td>".mysql_result($result,$i,expenditureId)."</td>";
			echo "<td>".get_fullname(mysql_result($result,$i,username),connection())."</td>";
			echo "<td>".mysql_result($result,$i,detail)."</td>";
			echo "<td>".mysql_result($result,$i,expenditure)."</td>";
			echo "<td>".mysql_result($result,$i,expenditure_time)."</td>";
		echo "</tr>";
	}
	echo "</table>";

	?>
	<hr />
	<a href ="index.php"><input type="button" value ="返回首页" /></a>
	</body>
</html>