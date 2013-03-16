<?php 
	include "checksecure.php";	
?>
<div class="header">Usergroups</div>
<p>
	<div class="box">
		<div class="text_area">
			<p>
				<div class="s_header">Actions</div>
			</p>
			<p>
				<form method="post" action="?p=page_edit&action=1">
					<input type="submit" value="Add New Group" />
				</form>
				<form method="post" action="?p=page_edit&action=4">
					<input type="submit" value="Add new title" />
				</form>
			</p>
		</div>
	</div>
</p>
<div class="text_area">
<form method="post" action="updategroups.php">
	<p>
		By creating groups you can handle your pages users much easier. 
	</p>
	<p>
		Set the default group for new users.
	</p>
	<p>
		
			<select name="default_group">
			<?php 				
				$query = mysql_query("SELECT * FROM ".$t_front."groups") or die(mysql_error());
				$result = mysql_num_rows($query);
				
				for($i = 0; $i < $result; $i++){
					echo "<option value='".mysql_result($query,$i,"id")."'>".mysql_result($query,$i,"name")."</option>";
				}
			?>
			</select>		
	</p>
	<p>
		<input type="submit" value="Save"/>
	</p>
</form>
</div>