<?php
function connection(){
	$link = mysql_connect("localhost","root","root");
	mysql_select_db(qs,$link);
	return $link;
}
?>