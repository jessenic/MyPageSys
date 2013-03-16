<?php include "../init.php";
include "checksecure.php";
?>

<html>
<head>
	<title><?php echo $page_title." - Administrator Control Panel"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
	
</head>
<body>
	<div id="main">
		<div id="header">
			<h1>MyPageSys v.0.1 - Administrator Control Panel</h1>
			<p>Here you can configure your webpage</p>
		</div>
		<div id="content_wrapper">
			<div id="navbar">
				<ul>
					<li><a href="?p=adm_home">Home</a></li>
					<li><a href="?p=main_settings">Main settings</a></li>
					<li><a href="#">Language packs</a></li>
					<li><a href="?p=navigation">Navigation</a></li>
					<li><a href="?p=users">Users</a></li>
					<li><a href="?p=groups">Groups</a></li>
					<li><a href="?p=main_settings">Forum</a></li>
					<li><a href="?p=pages">Pages</a></li>
					<li><a href="?p=pages">Articles</a></li>
					<li><a href="?p=styles">Styles</a></li>
					<li><a href="?p=files">Files</a></li>
					<li><a href="?p=help">Help</a></li>
					<li><a href="../index.php">Back to main page</a></li>
					<li><a href="../logout.php">Logout <?php echo $use_phpbb_sessions ? $user->data['username_clean'] : $_SESSION['username']; ?></a></li>
					
				</ul>
			</div>
		</div>
		<div id="content">
		
				
					<?php 
						if(!isset($_GET["p"])) { $p = "adm_home"; }
						else { $p = $_GET["p"]; }
						if(!file_exists($p . ".php")) { $p = "error"; }
						include($p . ".php");
					?>
				
		<div id="bottom_bar">MyPageSys - Copyright Juho Taskila, Darkside Coders 2010-2012</div>
		</div>

		
		<?php if(isset($_GET['msg'])){ ?>
		<div id="msg">
			<p><?php echo $_GET['msg']; ?></p>
			<p><a href="index.php">Close</a></p>
		</div>
		<?php } ?>
		
	</div>
</body>
</html>

