<?php
	include "../init.php";
	include "checksecure.php";
	$update_page_title = $_POST['set_page_title'];
	$update_page_name = $_POST['set_page_name'];
	$update_page_description = $_POST['set_page_description'];
	$update_page_keywords = $_POST['set_page_keywords'];
	$update_page_author = $_POST['set_page_author'];
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_page_title' WHERE name = 'page_title'") or die(mysql_error());
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_page_name' WHERE name = 'page_name'") or die(mysql_error());
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_page_description' WHERE name = 'page_description'") or die(mysql_error());
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_page_keywords' WHERE name = 'page_keywords'") or die(mysql_error());
	$query = mysql_query("UPDATE ".$t_front."settings SET data = '$update_page_author' WHERE name = 'page_author'") or die(mysql_error());
	mysql_close($connect);
	header("location: index.php?msg=Information updated succesful!");
	
?>