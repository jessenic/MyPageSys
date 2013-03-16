<?php
	include "../init.php";
	include "checksecure.php";
	$update_style_url = $_POST['set_style_url'];
	
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_style_url' WHERE name = 'style_url'") or die(mysql_error());	
	mysql_close($connect);
	header("location: index.php");
	
?>