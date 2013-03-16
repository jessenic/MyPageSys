<?php require "checksecure.php";?>
<div class="header">Control your web pages users</div>
<div class="text_area">

	<p>
		<div class="box">
			<div class="text_area">
				<p>
					<div class="s_header">Users</div>
				</p>
			</div>
		</div>
	</p>
	<?php if($use_phpbb_sessions){
	    ?>
    <p>phpBB user system is in use. Please modify users in phpBB settings.</p>
	    <?php
    }else{
        ?>
	<p>Here is a quick view of you pages users</p>
	<p>
		<form method="post">
			<table>
				<tr>
					<td>Search</td>
					<td><input type="text"></td>
					<td><select>
						<option>Username</option>
						<option>Email</option>
						<option>User-ID</option>
					</select></td>
					<td><input type="submit" value="Go">
				</tr>
			</table>
		</form>
	</p>
	
	<?php 	
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
		mysql_select_db($s_db) or die("DB error");
		
		$query = mysql_query("SELECT * FROM ".$t_front."users ORDER BY username ASC") or die(mysql_error($query));
		$result = mysql_num_rows($query);
		
		
		echo "<p><table class='borders'>
		<tr><th><b>ID</b></th><th><b>Username</b></th><th><b>Email</b></th><th><b>Account group</b></th><th><b>Registered</b></th><th><b>Actions</b></th></tr>";
		for($i = 0; $i <= $result -1; $i++){
			echo "<tr>
				<td>".mysql_result($query,$i,"ID")."</td>".
				"<td>".mysql_result($query,$i,"username")."</td>".
				"<td>".mysql_result($query,$i,"email")."</td>" .
				"<td>".mysql_result($query,$i,"usergroup")."</td>" .
				"<td>".mysql_result($query,$i,"registration_date")."</td>" .
				"<td><a href='../showprofile.php?user=".mysql_result($query,$i,"username")."' target='_blank'><img src='styles/img/profileicon.PNG' alt='view profile'></a> 
				<a href='?p=edit_user&user=".mysql_result($query,$i,"ID")."'><img src='styles/img/editicon.PNG' alt='edit account'></a></td>";
			echo "</tr>";
		}
		echo "</table></p>";
	}
	?>
</div>