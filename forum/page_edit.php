<?php
	include "checksecure.php";
	$action = $_POST['action'];
	if($action==1){ //sivun lisäys
	}elseif($action==2{ //sivun muokkaus
		$edit_page_id=$_POST['id'];
		//form
		echo "<form method='post'>
			<input type='text' name='page_name'>
			<textarea cols=50></textarea>
		</form>
		";
	}

?>