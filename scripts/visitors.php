<?php 

	//this is the visitor counter updater. You can view information through admin panel.
	//note! This script doesn't work without init.php include.
	//©Copyrights Darkside Coders 2012
	//Juho Taskila
	//
	//Use of this script in other applications is restricted.
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
	$date = mysql_real_escape_string(date("j").".".date("n").".".date("Y"));
	$ip =  $_SERVER['REMOTE_ADDR'];
	
	$query = mysql_query("SELECT * FROM ".$t_front."visitor_statistics WHERE ip='$ip'") or die(mysql_error());
	$result = mysql_num_rows($query);
	if($result == 1){
		//update the visit count
		$query = mysql_query("UPDATE ".$t_front."visitor_statistics SET hits = hits+1, last_visit = '$date' WHERE ip='$ip'") or die(mysql_error());
	}elseif($result == 0){
		//add new visitor to table
		//with mysql_num_rows it's easy to display unique user count which visited the website.
		$query = mysql_query("INSERT INTO ".$t_front."visitor_statistics (ip, date, hits) VALUES('$ip', '$date', '1')") or die(mysql_error());
		//now it inserts a new users ip address to database. Next time script will use other option.
	}
	
	
?>