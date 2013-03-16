<?php include "init.php"; ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<?php 
	include "scripts/update_online_users.php";
	include "scripts/visitors.php";	
?>

<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo "styles/".$style_url."/main.css" ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo "styles/".$style_url."/forum_main.css" ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta name="description" content="<?php echo $page_description; ?>" />
	<meta name="keywords" content="<?php echo $page_keywords; ?>" />
	<meta name="author" content="<?php echo $page_author; ?>" />
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

</head>
<body>

	<div id="main">		
		
		<div id="header">
			<img src="<?php echo "styles/".$style_url."/images/header.png"; ?>" width="100%" height="200px">
			<div id="search"><table><tr><td><form method="post"><input type="text" name="search_parameter" class="textinput"></form></td><td><input type="submit" value="Search"></td></tr></table></div>
		</div>


		<div id="navbar">
			<?php include "navbar_showlinks.php"; ?>
		</div>
		
		<div id="main_content_wrapper">		
			<div id="content">

			<p>
				<div class="text_box">				
					<div class="box_text_padding">				
						<p>
							<?php include "scripts/showcontent.php"; ?>
						</p>
					</div>					
				</div>
			</p>
			</div>
			<div id="right_sidebar">
				<div class="box_header">Members Area</div>
				
					<p>
						<?php include "membersarea.php"; ?>
					</p>
				
				<div class="box_header">Who is online?</div>
				<div class="box_text_padding">
					<p>
						<?php include "scripts/show_online_users.php" ?>
					</p>					
				</div>
				<div class="box_header">Latest On Forum</div>
				<div class="box_text_padding">
				//script for displaying newest forum posts
				</div>
				<div class="box_header">Articles</div>
				<div class="box_text_padding">
				<p>
					<p>
						<?php include "scripts/display_new_blog_posts.php" ?>
					</p>		
				</p>
						
				</div>
			</div>
		</div>
			
		
		<div class="box_footer">Site powered by <a href="http://www.mypagesys.com">MyPageSys</a>, &copy Copyright <?php echo $page_author; ?></div>
		
	</div>
	<div id="empty"> </div>
	<?php if(isset($_GET['msg'])){ ?>
		<div id="msg">
			<p><?php echo $_GET['msg']; ?></p>
			<p><a href="index.php">Close</a></p>
		</div>
	<?php } ?>
	
	<?php if(isset($_GET['question'])){		
			echo "<div id='msg'>";
			echo "<p>Are you sure?</p>";
			echo "<p><a href='".$_GET['question']."'>YES</a> | <a href='index.php'>NO</a></p></div>";
	} ?>
</body>
</html>