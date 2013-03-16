<?php
	require "../init.php";
	include "../admin/checksecure.php";
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
	//get the post data
	$post_host_page = $_POST['where'];
	$query = mysql_query("SELECT * FROM ".$t_front."blog_posts");
	$set_post_id=mysql_num_rows($query);
	$postidplus=0;
		while(true){
			$postidplus=$postidplus+1;			
			$query = mysql_query("SELECT * FROM ".$t_front."blog_posts WHERE post_id='$set_post_id'") or die(mysql_error());
			if(mysql_num_rows($query)==0){
				break;
			}else{
				$set_post_id = mysql_num_rows($query)+$postidplus;
			}
		}		
	$post_title = mysql_real_escape_string($_POST['title']);
	$post_data = mysql_real_escape_string($_POST['content']);
	$post_keywords = mysql_real_escape_string($_POST['keywords']);	
	$author = $_SESSION['username'];
	$time = date("U");
	$query = mysql_query("INSERT INTO ".$t_front."blog_posts (post_host_page, post_id, post_title, post_data, post_keywords, author, time) VALUES(
	'$post_host_page', '$set_post_id', '$post_title', '$post_data', '$post_keywords', '$author', '$time'
	)" ) or die(mysql_query($query));
	header('location: ../index.php?msg=Blog post submitted!')
?>