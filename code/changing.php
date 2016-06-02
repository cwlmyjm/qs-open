<?php
include "function.php";
ensure_login();
if ($_POST['expenditureId']==""||$_POST['expenditure']==""||$_POST['detail']==""){
	echo "<script>alert('好像有什么没填：（');</script>";
}else if (!check_expenditureId($_POST['expenditureId'],connection())){
	echo "<script>alert('记录不存在：（');</script>";
} else if (!check_rewritable($_POST['expenditureId'],connection())){
	echo "<script>alert('不可以更改一天前的纪录：（');</script>";
}else if (!is_numeric($_POST['expenditure'])){
	echo "<script>alert('好像有什么奇怪的东西进来了：（');</script>";
}else if (floatval($_POST['expenditure']) == 0){
	echo "<script>alert('梁学霸又来了：（');</script>";
} else {
	update_expenditure($_POST['expenditureId'],$_POST['expenditure'],$_POST['detail'],connection());
	echo "<script>alert('更改成功：（');</script>";
}
echo "<script>window.location.href='one.php';</script>";
?>
