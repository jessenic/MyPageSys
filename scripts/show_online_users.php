<?php 
	$vc_tpl = new Template("styles/".$style_url."/template/visitor_counter.html");	
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
	mysql_select_db($s_db) or die("db error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."users") or die(mysql_error($query));
	$registered_u = mysql_num_rows($query);
	
	$query = mysql_query("SELECT * FROM ".$t_front."users_online");
	$result = mysql_num_rows($query);
	$vc_tpl->set("vc_header",$language['who_is_online']);
	$vc_tpl->set("total",$lang_v_counter['totally_there_are']." ".$result." ".$lang_v_counter['users_online']);
	
	$guests = 0;
	$registered = 0;
	
	for($i = 0; $i < $result; $i++){
		$user = mysql_result($query, $i, "username");		
		if($user == "guest"){
			$guests = $guests + 1;
			$users[] = "";
		}else{
			$users[] = "<a href='showprofile.php?user=".$user."'>".$user."</a>, ";
			$registered = $registered + 1;
		}		
	}		
	$vc_tpl->set("userlist",implode($users));
	
	if($registered == 0){
		$vc_tpl->set("specification","<b>0</b> ".$lang_v_counter['registered']." <b>". $guests ."</b> ".$lang_v_counter['guest'].".");
	}else{
		$vc_tpl->set("specification"," ".$lang_v_counter['and']." <b>". $guests ."</b> ".$lang_v_counter['guest'].".");
	}
	echo "</p>";
	// lets count all unique users from database.
	$query = mysql_query("SELECT * FROM ".$t_front."visitor_statistics") or die(mysql_error());
	$unique_user_count = mysql_num_rows($query);
			
	$query = mysql_query("SELECT * FROM ".$t_front."users ORDER BY `registration_date` DESC LIMIT 1") or die(mysql_error());
	$vc_tpl->set("unique_users",$lang_v_counter['unique_users_on_page'].": ".$unique_user_count);
	$vc_tpl->set("newest_user",$lang_v_counter['newest_user'].": <a href='showprofile.php?user=".mysql_result($query,0,"username")."'>".mysql_result($query,0,"username")."</a>");
?>
