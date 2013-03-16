<?php 
	
	require "../init.php";
	require "checksecure.php";
	
	$type = $_POST['type'];
	
	if($type == "Widget page"){
		$u_type = 2;
	}elseif($type == "Normal page"){
		$u_type = 1;
	}
	
	$url = mysql_real_escape_string($_POST['widget_url']);
	
	
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("UPDATE ".$t_front."settings SET data='$u_type' WHERE name='homepage_type'") or die(mysql_error());
	$query = mysql_query("UPDATE ".$t_front."settings SET data='$url' WHERE name='homepage_url'") or die(mysql_error());
	header("location: index.php?msg=Homepage settings updated!");
?>