<?php
	include "init.php";
    if($use_phpbb_sessions && isset($_POST['username'])){
         $result = $auth->login($_POST['username'], $_POST['password'], true);
        
        switch($result['status']){
            case LOGIN_BREAK:
                header("location: index.php?msg=".urlencode($result['error_msg']));
                break;
            case LOGIN_ERROR_USERNAME:
            case LOGIN_ERROR_PASSWORD:
                header("location: index.php?msg=".urlencode("User not found! Please check your username and password!"));
                break;
            case LOGIN_ERROR_ATTEMPTS:
                header("location: index.php?msg=".urlencode("Too many failed login attempts!"));
                break;
            case LOGIN_SUCCESS:
            default:
                header("location: index.php"); 
            break;
        }
    }elseif(isset($_POST['username'])){	
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
			header("location: index.php?msg=".urlencode("User not found! Please check your username and password!"));
			die();
		}
			header("location: index.php");
	}

		
?>