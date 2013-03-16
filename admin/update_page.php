<?php 
	include "../init.php";
	include "checksecure.php";
	$action = $_GET['action'];
	
	if($action == 1){	
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
		mysql_select_db($s_db) or die("database error");
		$set_page_name = mysql_real_escape_string($_POST['page_name']);
		$set_page_content = mysql_real_escape_string($_POST['edit_content']);
		$set_visiblity = $_POST['showpage'];
		$set_page_type = $_POST['pagetype'];
		if($set_visiblity == "True"){
			$v = 0;
		}elseif($set_visiblity == "False"){
			$v = 1;
		}else{ $v = 0;}
		if($set_page_type == "Normal"){
			$s = 1;
		}elseif($set_page_type == "Article"){
			$s = 3;
		}else{
			$s = 1;
		}
		
		//creating id for the page
		$query = mysql_query("SELECT * FROM ".$t_front."pages");
		$set_page_id = mysql_num_rows($query)+1;
		$pageidplus=0;
		while(true){
			$pageidplus=$pageidplus+1;
			echo $pageidplus;
			$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE id='$set_page_id'");
			if(mysql_num_rows($query)==0){
				break;
			}else{
				$set_page_id = mysql_num_rows($query)+$pageidplus;
			}
		}
		//page position
		$query = mysql_query("SELECT * FROM ".$t_front."pages ORDER BY position DESC") or die(mysql_error());;		
	
		$set_position = mysql_result($query,0,"position")+1;

		
		$query = mysql_query("INSERT INTO ".$t_front."pages (type, name, id, text, visiblity, position) VALUES('$s' ,'$set_page_name', '$set_page_id', '$set_page_content', '$v', '$set_position' ) ") or die(mysql_error());  
		$d = mysql_real_escape_string(date("j").".".date("n").".".date("Y"));
		$qt = "UPDATE ".$t_front."pages SET last_update = '".$d."'WHERE id = $set_page_id";
		$query = mysql_query($qt);
		header("location: index.php?msg=Page was created succesfully!");
	}elseif($action == 2){
		$id = $_GET['id'];
		$update_page_type = $_POST['pagetype'];
		$update_page_name = $_POST['page_name'];
		$update_page_content = mysql_real_escape_string($_POST['edit_content']);
		$update_visiblity = $_POST['showpage'];
		
		
		
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
		mysql_select_db($s_db) or die("database error");
		
		if($update_page_type == "Normal"){
			$query = mysql_query("UPDATE ".$t_front."pages SET type='1' WHERE id = '$id'") or die(mysql_error());
		}elseif($update_page_type == "Article"){
			$query = mysql_query("UPDATE ".$t_front."pages SET type='3' WHERE id = '$id'") or die(mysql_error());
		}
			

					
		$query = mysql_query("UPDATE ".$t_front."pages SET name='$update_page_name' WHERE id = '$id'") or die(mysql_error());
		$query = mysql_query("UPDATE ".$t_front."pages SET text='$update_page_content' WHERE id = '$id'") or die(mysql_error());
		if($update_visiblity == "True"){
			$query = mysql_query("UPDATE ".$t_front."pages SET Visiblity=0 WHERE id = '$id'") or die(mysql_error());
		}elseif($update_visiblity == "False")
			$query = mysql_query("UPDATE ".$t_front."pages SET Visiblity=1 WHERE id = '$id'") or die(mysql_error());
		else{
		}
		
		$d = mysql_real_escape_string(date("j").".".date("n").".".date("Y"));
		$qt = "UPDATE ".$t_front."pages SET last_update = '".$d."'WHERE id = '$id'";
		
		$query = mysql_query($qt) or die(mysql_error());
		header("location: index.php?msg=Page was updated succesfully!");
	}elseif($action == 3){
		$id = $_GET['id'];
		$type = $_GET['type'];		
		if($id == 1){
			header("location:index.php?msg=Home page cannot be removed!");
			die();
		}
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
		mysql_select_db($s_db) or die("database error");
		
		$query = mysql_query("DELETE FROM ".$t_front."blog_posts WHERE post_host_page='$id'") or die(mysql_error());
		$query = mysql_query("DELETE FROM ".$t_front."pages WHERE id='$id'") or die(mysql_error());
		header("location: index.php?msg=Page was deleted succesfully!");
	}elseif($action == 4){
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
		mysql_select_db($s_db) or die("database error");
		$set_link_name = mysql_real_escape_string($_POST['title']);
		$set_link_url = mysql_real_escape_string($_POST['address']);
		//creating id for the link
		$set_page_id = uniqid();
		$set_link_type = "2";
		$query = mysql_query("INSERT INTO ".$t_front."pages (id, type, name, text) VALUES('$set_page_id','$set_link_type', '$set_link_name', '$set_link_url')") or die(mysql_error());
		header("location: index.php?msg=Link added succesfully!");
	}
		
?>
