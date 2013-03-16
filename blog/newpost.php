<?php require "../init.php" ?>
<?php include "../admin/checksecure.php"; ?>
<?php $to = $_GET['to']; ?>
<html>
<head>
	<title><?php echo $page_title." - New blog entry"; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo "../styles/".$style_url."/main.css" ?>">
</head>
<body>
	<div class="box">
		<div class="box_header">Add a new blog entry</div>
		<div class="wrapper">
		
		<div class="box_text_padding">	
			<p>
				<form method="post" action="savepost.php">
					<input name="where" type="hidden" value="<?php echo $to; ?>">
					<p>
						Post title
					</p>
					<p>
						<input class="textinput" type="text" size="50" name="title">
					</p>
					<p>
						Post content
					</p>
					<p>
						<textarea class="textinput" name="content" cols=70 rows=20></textarea>
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
				<a href="../index.php?p=<?php echo $to; ?>">Cancel</a>
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