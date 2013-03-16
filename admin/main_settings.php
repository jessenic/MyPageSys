<div class="header">
	Update your pages main settings
</div>
<div class="text_area">

<p><div class="box">
<div class="text_area">
<p>
<a href="#">Set default permissions</a> - Permissions can also be uniqued for every article, page, topic etc.
</p>
</div>
</div></p>
<p>
<?php
	include "checksecure.php";
 
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_title'");
	$get_page_title = mysql_result($query,0,"data");
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_name'");
	$get_page_name = mysql_result($query,0,"data");
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_description'");
	$get_page_description = mysql_result($query,0,"data");
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_keywords'");
	$get_page_keywords = mysql_result($query,0,"data");
	$query = mysql_query("SELECT * FROM ".$t_front."settings WHERE name='page_author'");
	$get_page_author = mysql_result($query,0,"data");
	
	echo "<form method='post' action='update_main_settings.php'>
	<table>
		<tr>
			<td>Pages title</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_page_title' value='". $get_page_title ."'/></td>
		</tr>
		<tr>
			<td>Pages name (displayed in pages header)</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_page_name' value='". $get_page_name ."'/></td>
		</tr>
		<tr>
			<td>Site description(meta)</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_page_description' value='". $get_page_description ."'/></td>
		</tr>
		<tr>
			<td>Site keywords(meta)</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_page_keywords' value='". $get_page_keywords ."'/></td>
		</tr>
		<tr>
			<td>Site author(meta)</td>
		</tr>	
		<tr>
			<td><input type='text' size='50' name='set_page_author' value='". $get_page_author ."'/></td>
		</tr>
		
		<tr>
			<td><input type='submit' value='Save changes'></td>
		</tr>
	</table>
	</form>";
?>
</p>

</div>