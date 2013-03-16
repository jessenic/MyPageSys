<?php
	include "init.php";
    if($use_phpbb_sessions){
        Header("Location: ".$phpbb_url."ucp.php?mode=login");
        die();
    }
	if(isset($_POST['username'])){	
		$username = mysql_real_escape_string($_POST['username']);
		$password = md5($_POST['password']);
		
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("problem in db connection");
		mysql_select_db($s_db) or die("db error");
		
		$query = mysql_query("SELECT * FROM ".$t_front."users WHERE username='$username' AND password='$password'");
		$result = mysql_num_rows($query);
		
		if($result == 1){
			$_SESSION['username'] = mysql_result($query,0,"username");
			$_SESSION['userid'] = mysql_result($query,0,"id");
			$_SESSION['account_group'] = mysql_result($query,0,"usergroup");
			
			$_SESSION['profile_img'] = mysql_result($query,0,"profile_img_url");
			$_SESSION['permissions'] = mysql_result($query,0,"permissions");
		

			$query = mysql_query("SELECT * FROM ".$t_front."groups WHERE id = ".$_SESSION['account_group']) or die(mysql_error($query));
			$result = mysql_num_rows($query);
			$_SESSION['account_group_str'] = mysql_result($query,0,"name");
			
		}else{
			header("location: index.php?msg=User not found! Please check your username and password!");
			die();
		}
			header("location: index.php");
	}

		
?>