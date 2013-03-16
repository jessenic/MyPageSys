<?php
	include "init.php";
    if($use_phpbb_sessions){
        $user->session_kill();
        $user->session_begin();
        header('location: index.php');
    }else{
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
	mysql_select_db($s_db) or die("db error");
	$sid = session_id();
	$query = mysql_query("DELETE FROM ".$t_front."users_online WHERE sid= '$sid'") or die(mysql_error());;
	session_destroy();
    header('location: index.php');
    }
	
?>