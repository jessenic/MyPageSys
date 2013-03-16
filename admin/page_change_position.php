<?php 
	require "../init.php";
	require "checksecure.php";
	$direction = $_GET['direction'];
	$id = $_GET['id'];
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE id = '".$id."'")or die(mysql_error($query));
	
	$current_position = mysql_result($query,0,"position");
	if($direction == "up"){
		$new_position = $current_position-1;
	}else if($direction == "down"){
		$new_position = $current_position+1;
	}
	
	$query = mysql_query("UPDATE ".$t_front."pages SET position=$new_position WHERE id = '$id'") or die(mysql_error());
	header("location: index.php?p=pages");
?>