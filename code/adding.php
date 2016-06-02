<?php
include "function.php";
ensure_login();
if ($_POST['expenditure']==""||$_POST['detail']==""){
	echo "<script>alert('好像有什么没填：（');</script>";
}
else if (!is_numeric($_POST['expenditure'])){
	echo "<script>alert('好像有什么奇怪的东西进来了：（');</script>";
}
else if (floatval($_POST['expenditure']) == 0){
	echo "<script>alert('你是梁学霸吗：（');</script>";	
}
else {
	add_expenditure($_COOKIE['username'],$_POST['expenditure'],$_POST['detail'],connection());
	echo "<script>alert('已经成功加入支出记录：（');</script>";
}
echo "<script>window.location.href='index.php';</script>";
?>
