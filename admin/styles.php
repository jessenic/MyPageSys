<div class="header">
	Update your pages style!
</div>
<div class="text_area">
<p>
<?php
	include "checksecure.php";
 
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='style_url'");
	$get_style_url = mysql_result($query,0,"data");
	
	
	echo "<form method='post' action='update_style.php'>
	<table>
		<tr>
			<td>Styles location(place your styles to styles folder and write here the folders name where the style is.)</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_style_url' value='". $get_style_url ."'/></td>
		</tr>
		<tr>
			<td><input type='submit' value='Save'></td>
		</tr>
		
	</table>
	</form>";
?>
</p>
</div>