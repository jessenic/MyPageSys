<?php
/*
Widget Overview-Homepage-v.0.1beta
©Copyright Darkside Coders. All rights reserverd. Copying and sharing is not allowed.
===Customer info===
Name: Allan Hiltunen
===================
*/

?>


<?php 
	/*
		Searching the newest posts from db and displaying them here.
	*/
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");	
	mysql_select_db($s_db) or die("DB error");
	mysql_query("SET NAMES 'utf8'"); 
	
	$query = mysql_query("SELECT * FROM ".$t_front."blog_posts ORDER BY `".$t_front."blog_posts`.`time` DESC LIMIT 5");
	$result = mysql_num_rows($query);
	
	if($result>0){
	
	for($i = 0; $i < $result; $i++){			
			//searching the image for post
			$text = mysql_result($query,$i,"post_data");
			$tag1 = "[img]";
			$tag2 = "[/img]";
			$possec = strpos($text, $tag2);
			$posfirst = strpos($text, $tag1);
			$lenght = $possec-$posfirst;
								
			$image_url = "<img src='".substr(mysql_result($query,$i,"post_data"),$posfirst+5,$lenght-5)."' alt='Post image'>";
			if($lenght == 0){
				$image_url = "";
			}
			
			
				
			
			
			$post_tpl = new Template("widgets/homepage/template/post.html");
			$post_data = BBCode(substr(mysql_result($query,$i,"post_data"),0,600));		
			$post_tpl->set("post_content", $post_data);
			$post_tpl->set("post_link","index.php?showpost=".mysql_result($query,$i,"post_id"));
			$post_tpl->set("post_name", mysql_result($query,$i,"post_title"));
			$post_tpl->set("read_more_tag", $lang_blog_post['read_more']."...");
			if(!isset($noimage)){
				$post_tpl->set("post_image",$image_url);
			}else{
				$post_tpl->set("post_image","http://www.irent.fi/uploads/7832/1_image.jpg");
			}
			$posts[] = $post_tpl->output();					
	}
		$content_tpl->set("posts", implode($posts, ""));
	}else{
		$content_tpl->set("posts", "");
	}
	
?>

