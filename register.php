<?php include "init.php" ?>
<html>
<head>
	<title><?php echo $page_title." - Register"; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo "styles/".$style_url."/main.css" ?>">
</head>
<body>
	<div id="main">
	<div class="box">
		<div class="box_header">Register a new account to <?php echo $page_name; ?></div>
		<div class="wrapper">
		<div class="half_wide">
		<div class="box_text_padding">	
			<p>
				<table>
					<form method="post" action="send_register.php">
						<tr>
							<td>Your new username (Length 3-20)</td>				
						</tr>
						<tr>
							<td><input type="text" name="new_username" class="textinput" /></td>				
						</tr>
						<tr>
							<td>Your email</td>				
						</tr>
						<tr>
							<td><input type="text" name="new_email" class="textinput"/></td>				
						</tr>
						<tr>
							<td>Date of birth(example 1.1.1995)</td>				
						</tr>
						<tr>
							<td><input type="text" name="new_birthday" class="textinput"/></td>				
						</tr>
						<tr>
							<td>Your new password(Length 6-50)</td>
						</tr>
						<tr>
							<td><input type="password" name="new_password" class="textinput"/></td>				
						</tr>
						<tr>
							<td>Your password again</td>
						</tr>
						<tr>
							<td><input type="password" name="new_password_again" class="textinput"/></td>				
						</tr>
						<tr>
							<td><input type="submit" name="send" value="Register new account!" class="textinput"/></td>				
						</tr>
					</form>
				</table>
			</p>
			<p>
				<a href="index.php">Cancel registration</a>
			</p>
		</div>
		</div>
		
		
		<div class="half_wide">
			<div class="box_text_padding">
				
			</div>
		</div>
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