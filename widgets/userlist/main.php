<?php 	
		$connect = mysql_connect($db_url,$db_username,$db_password) or die("Error in database connection!");
		mysql_select_db($s_db) or die("DB error");
		
		$query = mysql_query("SELECT * FROM ".$t_front."users ORDER BY username ASC") or die(mysql_error($query));
		$result = mysql_num_rows($query);
		
		echo "<p><font size=4>Users on this page</font></p>";
		echo "<p><table class='b_table' cellpadding = 10>
		<tr><td><b>Username</b></td><td><b>Account group</b></td><td><b>Registered</b></td></tr>";
		for($i = 0; $i <= $result -1; $i++){
			echo "<tr>".
				
				"<td><a href='showprofile.php?user=".mysql_result($query,$i,"username")."'>".mysql_result($query,$i,"username")."</a></td>".
				
				"<td>".mysql_result($query,$i,"usergroup")."</td>" .
				"<td>".mysql_result($query,$i,"registration_date")."</td>";
				
			echo "</tr>";
		}
		echo "</table></p>";
		echo "<font size=1>MyPageSys - Default widget - Userlist v1</font>"
	?>