<?php 
	
	if(isset($_GET['p'])){
		$p = mysql_real_escape_string($_GET['p']);
	}elseif(isset($_GET['widget'])){
		$w = mysql_real_escape_string($_GET['widget']);
	}
	elseif(isset($_GET['showpost'])){
		$post = mysql_real_escape_string($_GET['showpost']);
	}else{ // if nothing is selected -> page = homepage
		if($homepage_type == 1){
			$p = "1";
		}else if($homepage_type == 2){
			$w = $homepage_url;
		}
	}
	
	
	
	if(isset($p)){
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
	mysql_select_db($s_db) or die("db error");
	mysql_query("SET NAMES 'utf8'"); 
	$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE id='$p'");
	$result = mysql_num_rows($query);
		
	
	if($result == 0){
		$content_tpl = new MPSTemplate("styles/".$style_url."/template/error.html");// initializing the error page template
		$content_tpl->set("error_msg",$lang_content['404_page_not_found']);
	}else{	
		$views = mysql_result($query,0,"views") + 1;
		$type = mysql_result($query,0,"type");
		$update_query = mysql_query("UPDATE ".$t_front."pages SET views='$views' WHERE id='$p'") or die(mysql_error());
		if($type == 1){			
			$page_data = mysql_result($query,0,"text");
			
			$content_tpl = new MPSTemplate("styles/".$style_url."/template/page.html");
			$content_tpl->set("content", BBCode($page_data));
			$content_tpl->set("updated", $lang_content['page_updated'].": ".mysql_result($query,0,"last_update"));
			$content_tpl->set("views", $lang_content['page_viewed']." ".$views." ".$lang_content['times']);
	
		}elseif($type == 3){ //1 normal page, 2 link so we won't do anything for it here 3 is article page.
			$content_tpl = new MPSTemplate("styles/".$style_url."/template/article_page.html");
			$content_tpl->set("location","Salmitunturi.com -> Kehitysuutiset -> Artikkeli");
			if((isset($_SESSION['account_group']) && $_SESSION['account_group'] == 1) || ($use_phpbb_authentication ? $auth->acl_get('a_') : false)){
					$content_tpl->set("tool_newpost","<p>".$lang_content['tools'].": <a href='blog/newpost.php?to=$p'>".$lang_content['new_post']."</a>");
					$content_tpl->set("tool_newcategory","<a href=''>".$lang_content['new_gategory']."</a></p>");
			}else{
					$content_tpl->set("tool_newpost","");
					$content_tpl->set("tool_newcategory","");
			}
			$page_data = mysql_result($query,0,"text");
			$content_tpl->set("content", BBCode($page_data));
			
			
			$query = mysql_query("SELECT * FROM ".$t_front."blog_posts WHERE post_host_page='$p' ORDER BY `".$t_front."blog_posts`.`time` DESC") or die(mysql_error($query));
			$result = mysql_num_rows($query);
			if($result == 0){
			$content_tpl->set("posts",$lang_blog_post["no_blog_posts"]);
			}else{
			for($i = 0; $i <= $result - 1; $i++){
				$post_id = mysql_result($query, $i, "post_id");
				$time = date('d.m.Y - H:i', mysql_result($query,$i,"time"));
				$title = "<a href='index.php?showpost=".$post_id."'>".mysql_result($query,$i,"post_title")."</a>";
				$author = "<a href='showprofile.php?user=".mysql_result($query,$i,"author")."'>".mysql_result($query,$i,"author")."</a>";
				$content = BBCode(mysql_result($query,$i,"post_data"));
			
				$blogpost_tpl = new MPSTemplate("styles/".$style_url."/template/blogpost_s.html");				
				$blogpost_tpl->set("blog_post_header",$title);
				$blogpost_tpl->set("blog_post_author",$author);
				$blogpost_tpl->set("blog_post_date", $time);
				$blogpost_tpl->set("blog_post_content", $content);
				$blogpost_tpl->set("blog_post_action_comment","");
				$blogpost_tpl->set("blog_post_action_edit",$lang_blog_post['edit']);
				$blogpost_tpl->set("blog_post_action_delete",$lang_blog_post['delete']);												
				$posts[] = $blogpost_tpl->output();
			}
			$content_tpl->set("posts",implode($posts,""));
			}
		}
	}	
	}elseif(isset($post)){
		$content_tpl = new MPSTemplate("styles/".$style_url."/template/article_page.html");
	
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");	
		mysql_select_db($s_db) or die("db error");
			mysql_query("SET NAMES 'utf8'"); 
		$query = mysql_query("SELECT * FROM ".$t_front."blog_posts WHERE post_id='$post'") or die(mysql_error());
		$result = mysql_num_rows($query);
				
		if($result==0){
		
		}elseif($result > 1){
			die("A HUGE ERROR OCCURED! PLEASE CONTACT THE ADMINISTRATOR. SCRIPT TERMINATED");
		}else{
				$post_id = mysql_result($query, 0, "post_id");
				$time = date('d.m.Y - H:i', mysql_result($query,0,"time"));
				$title = "<a href='index.php?showpost=".$post_id."'>".mysql_result($query,0,"post_title")."</a>";
				$author = "<a href='showprofile.php?user=".mysql_result($query,0,"author")."'>".mysql_result($query,0,"author")."</a>";
				$content = BBCode(mysql_result($query,0,"post_data"));
			
				$blogpost_tpl = new MPSTemplate("styles/".$style_url."/template/blogpost_b.html");				
				$blogpost_tpl->set("blog_post_header",$title);
				$blogpost_tpl->set("blog_post_author",$author);
				$blogpost_tpl->set("blog_post_date", $time);
				$blogpost_tpl->set("blog_post_content", $content);
				$blogpost_tpl->set("blog_post_action_comment","");
				
				
				
                if((isset($_SESSION['account_group']) && $_SESSION['account_group'] == 1) || ($use_phpbb_authentication ? $auth->acl_get('a_') : false)){
					$blogpost_tpl->set("blog_post_action_delete","<a href='index.php?question=blog/delete.php?post=$post_id'>".$lang_blog_post['delete']."</a>");	
					$blogpost_tpl->set("blog_post_action_edit","<a href='blog/edit.php?post=$post_id'>".$lang_blog_post['edit']."</a>");	
				}else{
					$blogpost_tpl->set("blog_post_action_delete","");	
					$blogpost_tpl->set("blog_post_action_edit","");
				}
				$content_tpl->set("content",$blogpost_tpl->output());
				//setting tpl variables as empty because we don't need 'em
				$content_tpl->set("tool_newpost","");
				$content_tpl->set("posts","");
		}	
		
	}elseif(isset($w)){
		$content_tpl = new MPSTemplate("widgets/".$w."/template/main.html");// initializing the error page template
		include "widgets/".$w."/main.php";
		
		
	}
	
	
?>