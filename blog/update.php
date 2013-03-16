<?php
	require "../init.php";
	include "../admin/checksecure.php";
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
	//get the post data
	$post_host_page = $_POST['where'];
	$post_id = uniqid();
	$post_title = mysql_real_escape_string($_POST['title']);
	$post_data = mysql_real_escape_string($_POST['content']);
	$post_keywords = mysql_real_escape_string($_POST['keywords']);	
	$author = $use_phpbb_sessions ? $user->data['username_clean'] : $_SESSION['username'];
	$time = date("U");
	$query = mysql_query("UPDATE ".$t_front."blog_posts (post_host_page, post_id, post_title, post_data, post_keywords, author, time) VALUES(
	'$post_host_page', '$post_id', '$post_title', '$post_data', '$post_keywords', '$author', '$time'
	)" ) or die(mysql_error($query));
	header('location: ../index.php?msg=Blog post submitted!')
?>