<?php 
	include "init.php";
    if($use_phpbb_sessions){
        header("Location: ".$phpbb_url."ucp.php?mode=register");
        die();
    }
	$new_name = mysql_real_escape_string($_POST['new_username']);
	$new_email = mysql_real_escape_string($_POST['new_email']);
	$new_password = md5($_POST['new_password']);
	$new_password_again = md5($_POST['new_password_again']);
	
	
	if(strlen($_POST['new_username']) <= 20 && $_POST['new_email'] && $_POST['new_password'] && $_POST['new_password_again']){
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("problem in db connection");
		mysql_select_db($s_db) or die("db error");
		//check if username already taken
		$query = mysql_query("SELECT * FROM ".$t_front."users WHERE username='$new_name'") or die(mysql_error());;
		$result = mysql_num_rows($query);
	
		if($result == 0){
			//continue
		}else{
			header("location:register.php?msg=Username already taken!");
		}
		if($new_password == $new_password_again){								
				$date = date("U");
					$loop = true;
					while($loop = true){
						$id = uniqid();
						$query = mysql_query("SELECT * FROM ".$t_front."users WHERE id='$id'") or die(mysql_error());
						$result = mysql_num_rows($query);
						if($result == 0){ break;}
					}
					$set_user_id = $id;
				$query = mysql_query("SELECT * FROM ".$t_front."groups WHERE name='default_group'");
				$default_group = mysql_result($query,0,"data");
				$query = mysql_query("INSERT INTO ".$t_front."users (id, username, password, email, usergroup, registration_date) VALUES('$set_user_id','$new_name' ,'$new_password', '$new_email', '$default_group', '$date') ") or die(mysql_error());  
				
				
			header("location: index.php?msg=Your account has been registered succesfully!");
		}else{
			header("location: register.php?msg=Passwords don't match!");
			die();
		}
	}else{
		header("location: register.php?msg=Please fill all fields!");
		die();
	}
?>