<?php include "init.php";
if(!isset($_SESSION['username'])){
	header("location:index.php?msg=You don't have enough rights to view this content. Please login or register.");
}else{
	$current_user = $_SESSION['username'];
}

?>
<html>
<head>
	<title><?php echo $page_title." - View user profile"; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo "styles/".$style_url."/main.css" ?>">
</head>

<?php
 
 
 echo "<br>";
	//getting user info from database
	$username = mysql_real_escape_string($_GET['user']);
	$query = mysql_query("SELECT * FROM ".$t_front."users WHERE username='$username'") or die(mysql_error());
	$result = mysql_num_rows($query);
	
	if($result == 0){
	}elseif($result == 1){
		$user_email = mysql_result($query, 0, "email");
		$user_registration_date = mysql_result($query, 0, "registration_date");
	}elseif($result > 1){
		die("A fatal error has occured. Please contact administrator.");
	}
?>

<body>
	<div id="main">

	<div class="box">
		<div class="half_wide">
		<div class="box_text_padding">	
		<p><div class="box_header">View User Profile <?php echo $_GET['user']; ?></div></p>
			<p>
				<div class="profile_img"></div>
			</p>
			<p>
				Email <?php echo $user_email; ?>
			</p>
			<p>
				User since <?php echo $user_registration_date; ?>
			</p>
			<p>
				<a href="index.php">Back</a>
			</p>
		</div>
		</div>
		<div class="half_wide">
			<div class="box_text_padding">
				<p><div class="box_header">About me</div></p>
				<p>
					User info
				</p>
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