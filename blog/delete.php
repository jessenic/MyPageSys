<?php 
	require "../init.php";
	include "../admin/checksecure.php";
	$d_post_id = $_GET['post'];				
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
	$query = mysql_query("DELETE FROM ".$t_front."blog_posts WHERE post_id='".$d_post_id."'") or die(mysql_error());
	header("location:../index.php?msg=Post deleted succesfully!");
?>