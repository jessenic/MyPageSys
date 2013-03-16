<?php 
	require "init.php";
	$url = $_GET['url'];
	$id = $_GET['id'];
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
	mysql_select_db($s_db) or die("db error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE id='$id'") or die(mysql_error());	
	
	$views = mysql_result($query,0,"views") + 1;
	$type = mysql_result($query,0,"type");
	$update_query = mysql_query("UPDATE ".$t_front."pages SET views='$views' WHERE id='$id'") or die(mysql_error());
	header("location: ".$url);
    echo "You will be redirected to another page.";
?>