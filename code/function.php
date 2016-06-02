<?php
date_default_timezone_set("Etc/GMT");

include "database.php";

function login($username,$password,$link){
	$result = mysql_query("select password from users where username = '$username'",$link);
	if (mysql_fetch_array($result)){
		$password_mysql = mysql_result($result,0);
		if ($password_mysql == $password){
			$randomkey = md5(rand());
			mysql_query("update users set randomkey = '$randomkey' where username = '$username'",$link);
			mysql_query("update users set logintime = current_timestamp where username = '$username'",$link);
			set_cookie($username,$randomkey);
			echo "<script>alert('登陆成功了：）');</script>";
		}
		else{
			echo "<script>alert('密码不对哟：（');</script>";
		}
	}
	else{
		echo "<script>alert('用户不存在：（');</script>";
	}
	echo "<script>window.location.href='index.php';</script>";
}

function set_cookie($username,$randomkey){
	setcookie(username,$username,time()+604800);
	setcookie(randomkey,$randomkey,time()+604800);
}

function check_login($link){
	if (isset($_COOKIE["username"])&&isset($_COOKIE["randomkey"])){
		$username = $_COOKIE['username'];
		$randomkey = $_COOKIE['randomkey'];
		$result = mysql_query("select * from users where username = '$username'",$link);
		if (mysql_fetch_array($result)){
			$logintime = mysql_result($result,0,logintime);
			$randomkey_mysql = mysql_result($result,0,randomkey);
			if (gettimeofday(true)<strtotime($logintime)+604800){
				if ($randomkey != $randomkey_mysql){
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		return true;
	}
	else{
		return false;
	}

}

function ensure_login(){
	if (!check_login(connection())){
		header("location:index.php");
	}
}

function select_all($link){
	$result = mysql_query("select sum(expenditure) from expenditure_details",$link);
	if (mysql_result($result,0)==null){
		return 0;
	}
	else{
		return mysql_result($result,0);
	}
}

function select_one($username,$link){
	$result = mysql_query("select sum(expenditure) from expenditure_details where username = '$username'",$link);
	if (mysql_result($result,0)==null){
		return 0;
	}
	else{
		return mysql_result($result,0);
	}
}

function select_all_users($link){
	return mysql_query("select * from users");
}

function add_expenditure($username,$expenditure,$detail,$link){
	mysql_query("insert into expenditure_details (username,detail,expenditure) values ('$username','$detail','$expenditure')",$link);
}

function get_fullname($username,$link){
	return mysql_result(mysql_query("select fullname from users where username = '$username'",$link),0);
}

function get_all_expenditure($link){
	return mysql_query("select * from expenditure_details",$link);
}

function get_one_expenditure($username,$link){
	return mysql_query("select * from expenditure_details where username = '$username'",$link);
}

function check_expenditureId($expenditureId,$link){
	$result = mysql_query("select * from expenditure_details where expenditureId = '$expenditureId'",$link);
	return mysql_fetch_array($result);
}

function check_rewritable($expenditureId,$link){
	$result = mysql_query("select expenditure_time from expenditure_details where expenditureId = '$expenditureId'",$link);
	return (gettimeofday(true)<strtotime(mysql_result($result,0))+86400);
}

function update_expenditure($expenditureId,$expenditure,$detail,$link){
	$old = mysql_query("select * from expenditure_details where expenditureId = '$expenditureId'",$link);
	mysql_query("update expenditure_details set expenditure = '$expenditure',detail = '$detail' where expenditureId = '$expenditureId'",$link);
	$new = mysql_query("select * from expenditure_details where expenditureId = '$expenditureId'",$link);
	save_change($expenditureId,$old,$new,$link);
}

function save_change($expenditureId,$old,$new,$link){
	$username = $_COOKIE['username'];
	$expenditure_old = mysql_result($old,0,expenditure);
	$expenditure_new = mysql_result($new,0,expenditure);
	$detail_old = mysql_result($old,0,detail);
	$detail_new = mysql_result($new,0,detail);
	$sql = "insert into change_history (username,expenditureId,expenditure_old,expenditure_new,detail_old,detail_new)
	values ('$username','$expenditureId','$expenditure_old','$expenditure_new','$detail_old','$detail_new')";
	mysql_query($sql,$link);
}
?>