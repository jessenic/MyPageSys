<?php 
	$sid = session_id();
	$time = time();
	$rtime = time()-300;
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
	mysql_select_db($s_db) or die("db error");
	$query = mysql_query("SELECT * FROM ".$t_front."users_online WHERE sid='$sid'") or die(mysql_error());
	$result = mysql_num_rows($query);
    if($use_phpbb_sessions && $user->data['user_id'] != ANONYMOUS){
        $username = $user->data['username'];
    }elseif(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	if($result == 0){
		$query = mysql_query("INSERT INTO ".$t_front."users_online (username, sid, time) values('guest', '$sid', '$time')");
	}
	else{
		if(isset($username))
		{
			$query = mysql_query("UPDATE ".$t_front."users_online SET username='$username' WHERE sid='$sid'");
		}else{
			$query = mysql_query("UPDATE ".$t_front."users_online SET username='guest' WHERE sid='$sid'");
		}
		$query = mysql_query("UPDATE ".$t_front."users_online SET time='$time' WHERE sid='$sid'");
	}		
	
	$query = mysql_query("DELETE FROM ".$t_front."users_online WHERE time<$rtime") or die(mysql_error());;
	
	
?>