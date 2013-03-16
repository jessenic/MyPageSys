<?php 
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE visiblity = 0 ORDER BY position ASC");
	$result = mysql_num_rows($query);	
	
	
	
	for($i = 0; $i <= $result - 1; $i++){	
		$type = mysql_result($query,$i,"type");
		$name = mysql_result($query,$i,'name');
		$ID = mysql_result($query,$i,"ID");
		if($type == 1){
			if($ID == 1 && $homepage_type == 2){
				$link="index.php?widget=".$homepage_url;
				$link_title=$name;				
			}else{			
				$link ="index.php?p=".$ID;
				$link_title=$name;								
			}
		}elseif($type == 2){
			
			$url = mysql_result($query,$i,"text");
			$title = mysql_result($query,$i,"name");
			$id = mysql_result($query,$i,"id");
			
			$link = "link.php?url=$url&id=$id";
			$link_title = $title;
		}elseif($type == 3){ //all widget links, blogs, forums etc.
			$link = "index.php?p=".$ID;
			$link_title = $name;
		}
		
		//output via template script

		

		$link_tpl = new Template("styles/".$style_url."/template/navbar_link.html");
		$link_tpl -> set("link_location",$link);
		$link_tpl -> set("link_title",$link_title);
		$links[] = $link_tpl->output();						
	}		
	$navbar_tpl->set("links",implode($links,""));
	
?>