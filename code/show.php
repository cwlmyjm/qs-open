<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
function_exists(ensure_login) or include "function.php";
ensure_login();
echo "<p>已经总共支出了：";
echo sprintf("%.2f", select_all(connection()));
echo "镑。</p>";

$result = select_all_users(connection());
for ($i = 0;$i < mysql_num_rows($result);$i++){
	echo "<p>";
	echo mysql_result($result,$i,fullname);
	echo "已经支出了";
	echo sprintf("%.2f", select_one(mysql_result($result,$i,username),connection()));
	echo "镑。</p>";
}
?>

<hr />
<form action="adding.php" method="post">
	<p><input type="text" name="expenditure" placeholder="支出金额" /></p>
	<p><textarea type="text" name="detail" placeholder="支出详细" /></textarea></p>
	<p><input type="submit" value="提交"></p>
</form>
<hr />
<a href="all.php"><input type="button" value ="查看总的支出记录" onclick ="all.php" /></a>
<hr />
<a href="one.php"><input type="button" value ="查看我的支出记录" onclick ="all.php" /></a>

<hr />
<script src="exit.js"></script>
<p>当前登陆用户：
<?php
echo get_fullname($_COOKIE['username'],connection());
?>
</p>
<input type="button" value = "退出登录" onclick = exit() />