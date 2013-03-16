<div class="header">
	Here you can control your pages
</div>
<div class="text_area">
<p>
	<div class="box">
		<div class="text_area">
			<p>
				<div class="s_header">Main actions</div>
			</p>
			<p>
				<form method="post" action="?p=page_edit&action=1">
					<input type="submit" value="Add New Page" />
				</form>
				<form method="post" action="?p=page_edit&action=4">
					<input type="submit" value="Add link to external page" />
				</form>
				<form method="post" action="?p=edit_homepage">
					<input type="submit" value="Edit home page settings" />
				</form>
			</p>
		</div>
	</div>
</p>
<p>
		<form method="post">
			<table>
				<tr>
					<td>Search</td>
					<td><input type="text"></td>
					<td><select>
						<option>Name</option>
						<option>ID</option>
						
					</select></td>
					<td><input type="submit" value="Go">
				</tr>
			</table>
		</form>
	</p>
<p>
<?php
	include "checksecure.php";	
	
	if(isset($_GET['show'])){
		$limit = $_GET['show'];
	}
	if(!isset($_GET['show'])){
		$limit = 10;
	}
	
	
	if(isset($_GET['sub_p'])){
		$sub_page = $_GET['sub_p'];
	}if(!isset($_GET['sub_p'])){
		$sub_page = 1;
	}
	
	
	$query = mysql_query("SELECT * FROM ".$t_front."pages") or die(mysql_error());
	$result = mysql_num_rows($query);
	
	$pages = $result/$limit;
	
	if($result % $limit != 0){
		$pages + 1;
	}
	
	$start = (0+$sub_page-1)*$limit;
	
	$end = $limit;
	
	$connect = mysql_connect($db_url,$db_username,$db_password) or die("database connection error");
	mysql_select_db($s_db) or die("database error");
	
	$query = mysql_query("SELECT * FROM ".$t_front."pages ORDER BY position ASC LIMIT $start,$end") or die(mysql_error());
	$result = mysql_num_rows($query);
	
	echo "<form method='post' action='update_main_settings.php'>
	<table class='borders'>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>ID</th>
			
			<th>Navbar</th>
			<th>Published</th>
			<th>Views</th>
			<th>Actions</th>
			<th>Page position in nav</th>
		</tr>";
	for($i = 0; $i <=$result - 1; $i++){
		if(mysql_result($query,$i,"Visiblity") == 0)
			$visible = "<img src='styles/img/yesicon.PNG'>";
		else	
			$visible = "<img src='styles/img/noicon.PNG'>";
		if(mysql_result($query,$i,"type") == 1)
			$page_type = "Page";
		elseif(mysql_result($query,$i,"type") == 3)
			$page_type = "Article page";
		else
			$page_type = "Link";
		
		$published = "<img src='styles/img/yesicon.PNG'>";
		echo "<tr>";
		echo "<td><b>".mysql_result($query,$i,"Name")."</b></td>";
		echo "<td>".$page_type."</td>";
		echo "<td>".mysql_result($query,$i,"ID")."</td>";
		
		echo "<td>".$visible."</td>";			
		echo "<td>".$published."</td>";
		echo "<td>".mysql_result($query,$i,"Views")."</td>";
		echo "<td><a href='../index.php?p=".mysql_result($query,$i,"ID")."' target='_blank'><img src='styles/img/viewicon.PNG' alt='view'></a> 
		<a href='?p=page_edit&action=2&id=".mysql_result($query,$i,"ID")."'><img src='styles/img/editicon.PNG' alt='edit'></a> 
		<a href='?p=page_edit&action=3&id=".mysql_result($query,$i,"ID")."&type=".mysql_result($query,$i,"type")."'><img src='styles/img/removeicon.PNG' alt='remove'></a></td>";
		echo "<td><a href='page_change_position.php?direction=up&id=".mysql_result($query,$i,"ID")."'><img src='styles/img/upicon.PNG' alt='up'></a>
		<a href='page_change_position.php?direction=down&id=".mysql_result($query,$i,"ID")."'><img src='styles/img/downicon.PNG' alt='down'></a> | Current ".mysql_result($query,$i,"position")."</td>";
		echo "</td>";			
	}
		
	echo "
	</table>
	</form>";
?>
</p>
<p>
	<div class="box">
		<div class="text_area">
			<p>
				<form method="post">
					<table>
						<tr>
							<td>Show</td>							
							<td><a href="?p=pages&show=1">10</a> | <a href="?p=pages&show=2">25</a> | <a href="?p=pages&show=3">50</a> | <a href="?p=pages&show=0">All</a> |</td>
							<td>&nbsp;</td>
							<td>Page</td>							
							<td>
								<<
								<?php 
									for($i = 1; $i<$pages; $i++){
										echo "<a href='#'></a><a href='?p=pages&show=".$limit."&sub_p=".$i."'>".$i."</a> <a href='#'></a>";
									}
								?>
								>>
							</td>
							
						</tr>
					</table>
				</form>
			</p>
		</div>
	</div>
</p>
</div>