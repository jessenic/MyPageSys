<div class="text_area">
<p>

<?php
	include "checksecure.php";
	$action = $_GET['action'];
	if($action==1){ //sivun lisäys
			echo "	<div class='box'>
				<div class='text_area'>
					<p>
						<div class='s_header'>Creating a new page</div>
					</p>
					<p>
						Creating a new page for your website is very easy! Just fill the form below and press save and your page will be added to mysql database.
						You can select is the page visible in navbar or not.
					</p>
				</div>
			</div>";
			
			echo "	
		<form method='post' action='update_page.php?action=1'>
		<p>
			<table>		
				<tr>
					<td>Pages name</td>
				</tr>
				<tr>
					<td><input type='text' size=50 name='page_name'></td>
				</tr>
				<tr>
					<td>Pages content</td>
				</tr>
				<tr>
					<td><textarea cols=100 rows=20 name=edit_content></textarea></td>
				</tr>				
			</table>
		</p>
		<p>
			<div class='box'>
				<div class='text_area'>

					<p>";
						include "instructions.php";
					echo "</p>
				</div>
			</div>
		</p>
		<p>
			Page type: <input type='radio' name='pagetype' value='Normal'> Normal page <input type='radio' name='pagetype' value='Article'> Article page
		</p>
		<p>
			Visible in navbar: <input type='radio' name='showpage' value='True'> True <input type='radio' name='showpage' value='False'> False
		</p>
		<p>
			Allow comments: <input type='radio' name='showpage' value='True'> True <input type='radio' name='showpage' value='False'> False
		</p>
		<p>
			<input type='submit' value='Save'>
		</p>
		</form>";
	}elseif($action==2){ //sivun muokkaus
		$edit_page_id=$_GET['id'];
		//myslq kyselyt
			$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
			mysql_select_db($s_db) or die("database error");
			
			$query = mysql_query("SELECT * FROM ".$t_front."pages WHERE id='$edit_page_id'");
			$name = mysql_result($query,0,"name");
			$content = mysql_result($query,0,"text");
			$pagetype = mysql_result($query,0,"type");
			$pagevisiblity = mysql_result($query,0,"visiblity");
			if($pagetype = "3"){
				$t_selected2 = "checked='true'";
				$t_selected1 = "";
			}elseif($pagetype = "1"){
				$t_selected1 = "checked='true'";
				$t_selected2 = "";
			}
			
			if($pagevisibility = "1"){
				$selected2 = "checked='true'";
				$selected1 = "";
			}elseif($pagevisibility = "0"){			
				$selected2 = "";
				$selected1 = "checked='true'";
			}
			
		//form
		echo "	
		<form method='post' action='update_page.php?action=2&id=".$edit_page_id."'>
		<p>
			<table>		
				<tr>
					<td>Pages name</td>
				</tr>
				<tr>
					<td><input type='text' size=50 name='page_name' value='".$name."'></td>
				</tr>
				<tr>
					<td>Pages content</td>
				</tr>
				<tr>
					<td><textarea cols=100 rows=20 name=edit_content>".$content."</textarea></td>
				</tr>				
			</table>
		</p>
		<p>
			<div class='box'>
				<div class='text_area'>

					<p>";
						include "instructions.php";						
					echo "</p>
				</div>
			</div>
		</p>		
		<p>
			Page type: <input type='radio' name='pagetype' value='Normal'".$t_selected1."> Normal page <input type='radio' name='pagetype' value='Article'".$t_selected2."> Article page
		</p>
		<p>
			Visible in navbar: <input type='radio' name='showpage' value='True'".$selected1."> True <input type='radio' name='showpage' value='False'".$selected2."> False
		</p>
		<p>
			Allow comments: <input type='radio' name='showpage' value='True'> True <input type='radio' name='showpage' value='False'> False
		</p>
		<p>
			<input type='submit' value='Save'>
		</p>
		</form>
		
		";
	}elseif($action == 3){
		$edit_page_id=$_GET['id'];
		$edit_page_type=$_GET['type'];
		echo "<p>
			<div class='s_header'>Are you sure you want delete this page? </div>
		</p>
		<p>
			If the page is and article page, all posts under that page will also be deleted!
		</p>
		<p>
			<div class='box'>
				<div class='text_area'><p><a href='update_page.php?action=3&id=".$edit_page_id."&type=".$edit_page_type."'>YES</a>
				|
				<a href='index.php?p=pages'>NO</a></p></div>
			</div>
		</p>
		";
	}elseif($action == 4){
		echo "<form method='post' action='update_page.php?action=4'>
			<p>
				<div class='box'>
					<p>
						<div class='s_header'><div class='text_area'>Create a link to external page witch is shown in navbar</div></div>
					</p>
				</div>
			</p>
			<p>
				<b>Title</b>
			</p>
			<p>
				<input type='text' name='title'>
			</p>
			<p>
				<b>URL</b>(example http://www.somepage.com) *NOTE URL MUST BE FULL, http:// PART INCLUDED!
			</p>
			<p>
				<input type='text' name='address'>
			</p>
			<p>
				<input type='submit' value='Save'>
			</p>
		</form>
		";
	}

?>
<p>
	<a href="index.php">Cancel</a>
</p>
</div>