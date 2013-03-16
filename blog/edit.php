<?php require "../init.php" ?>
<?php include "../admin/checksecure.php"; ?>
<?php $post = $_GET['post']; 

	$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
	mysql_select_db($s_db) or die("DB error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."blog_posts WHERE post_id = '$post'") or die(mysql_error());
	$result = mysql_num_rows($query);
	
	if($result == 0){
		header("location:../index.php?msg=Post not found!");
	}else{
		$post_title = mysql_result($query,0,"post_title");
		$post_data = mysql_result($query,0,"post_data");
		
	}

?>
<html>
<head>
	<title><?php echo $page_title." - New blog entry"; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo "../styles/".$style_url."/main.css" ?>">
</head>
<body>
	<div class="box">
		<div class="box_header">Edit a blog entry</div>
		<div class="wrapper">
		
		<div class="box_text_padding">	
			<p>
				<form method="post" action="update.php">				
					<input type="hidden" name="where" value="<?php echo $post; ?>">
					<p>
						Post title
					</p>
					<p>
						<input class="textinput" type="text" size="50" name="title" value="<?php echo $post_title;?>">
					</p>
					<p>
						Post content
					</p>
					<p>
						<textarea class="textinput" name="content" cols="70" rows="20"><?php echo $post_data;?> </textarea>
					</p>
					<p>
						Keywords(example "My first post" "Tutorial")
					</p>
					<p>
						<input class="textinput" type="text" name="keywords" size="50">
					</p>
					<p>
						Category
					</p>
					<p>
						<select>
							<option class="textinput">General</option>
						</select>
					</p>
					<p>
						<input type="submit" value="Save">
					</p>
				</form>
			</p>
			<p>
				<a href="../index.php?showpost=<?php echo $post; ?>">Cancel</a>
			</p>
		</div>
		</div>		
		
	</div>
	
		<?php if(isset($_GET['msg'])){ ?>
		<div id="msg">
			<p><?php echo $_GET['msg']; ?></p>
			<p><a href="register.php">Close</a></p>
		</div>
		<?php } ?>
</body>
</html>