<?php 

	function InitConnection(){
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
		mysql_select_db($s_db) or die("database error");
	}

?>