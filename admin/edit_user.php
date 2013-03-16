<?php 
	$user_id = $_GET['user'];
	$query = mysql_query("SELECT * FROM ".$t_front."users WHERE id = '$user_id'");
	$id = mysql_result($query,0,"id");
	$username = mysql_result($query,0,"username");
	$email = mysql_result($query,0,"email");
?>

<div class="header">
	Edit Account
</div>
<p>
	<div class="box">
		<div class="text_area">
			<p>
				<div class="s_header">
					<p>
						Main
					</p>		
				</div>
				<?php echo "User ID: ". $id; ?>
			</p>
		</div>
	</div>
</p>
<div class="text_area">
	
	<form method="post" action="update_user.php">
	<p>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="new_username" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="new_password"></td>
			</tr>
			<tr>
				<td>Email address</td>
				<td><input type="text" name="new_email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td>Administrator rights</td>
				<td><input type="radio" name="adm" value="yes">Yes<input type="radio" name="adm" value="no">No</td>
			</tr>
		</table>
	</p>
	<p>
		<input type="submit" value="Save changes">
	</p>
	</form>
</div>


<div class="box">
	<div class="text_area">
		<p>
			<div class="s_header">Ban or delete user</div>
		</p>
	</div>
</div>
