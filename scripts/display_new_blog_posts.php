<?php
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
			$query = mysql_query("SELECT * FROM ".$t_front."blog_posts ORDER BY `".$t_front."blog_posts`.`time` DESC LIMIT 0,5") or die(mysql_error($query));
			$result = mysql_num_rows($query);
			if($result == 0){
			echo "<p><i>".$lang_blog_post['no_blog_posts']."</i></p>";
			}
			for($i = 0; $i <= $result - 1; $i++){							
				$time = date('d.m.Y', mysql_result($query,$i,"time")); 
				echo "<p><a href='index.php?showpost=".mysql_result($query,$i,"post_id")."'><b>".mysql_result($query,$i,"post_title")."</b> - ".mysql_result($query,$i,"author");
			}
?>