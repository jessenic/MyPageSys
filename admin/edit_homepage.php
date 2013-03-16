<?php
	
	require "checksecure.php";
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='homepage_type'");		
	$homepage_type = mysql_result($query,0,"data");	
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='homepage_url'");		
	$homepage_url = mysql_result($query,0,"data");			
?>

<div class="header">
	Edit your sites homepage
</div>

<div class="text_area">
<p>
	<div class="box">
		<div class="text_area">
			<p>
				<div class="s_header">Homepage settings</div>
			</p>

		</div>
	</div>
			
				<form method="post" action="update_homepage.php">
					<p>
					<select name="type">
						<?php if($homepage_type == 1){
							echo "<option name='normal' selected>Normal page</pption>
								<option name='widget'>Widget page</pption>";
						}elseif($homepage_type == 2){
							echo "
							<option name='normal'>Normal page</pption>
							<option name='widget' selected>Widget page</pption>";
						}
						?>
						
					</select>
					</p>
					<p>
						If you have a widget homepage installed type the widget folders name here.(example "myhomepage")
					</p>	
					<p>
						<input type="text" name="widget_url" value="<?php echo $homepage_url; ?>">
					</p> 
					<p>
					<input type="submit" value="Save">
					</p>
				</form>
			
</p>
<p>
</div>