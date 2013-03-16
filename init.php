<?php
    require "dbsettings.php" or die("Failed to load database settings.");
    //PHPBB Session integration
    if($use_phpbb_sessions){
        define('IN_PHPBB', true);
        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);
    
        // Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup();
    }
    // end PHPBB Session integration 
	require "header.php";			
	include "files/functions.php";
	define('PAGE_ROOT','http://localhost/mypagesys/');
	header("Content-Type: text/html; charset=UTF-8");

	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
		mysql_select_db($s_db) or die("DB error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='homepage_type'");		
	$homepage_type = mysql_result($query,0,"data");	
	if($homepage_type==1) //normal
	{
		//don't do nothign
	}else if($homepage_type==2) //a widget page
	{
		$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='homepage_url'");		
		$homepage_url = mysql_result($query,0,"data");			
	}
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='style_url'");		
	$style_url = mysql_result($query,0,"data");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_title'");		
	$page_title = mysql_result($query,0,"data");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_name'");		
	$page_name = mysql_result($query,0,"data");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_description'");
	$page_description = mysql_result($query,0,"data");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_keywords'");
	$page_keywords = mysql_result($query,0,"data");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_author'");
	$page_author = mysql_result($query,0,"data");
	
	
	

?>