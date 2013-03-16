<?php 
	if(isset($_SESSION['username']) && isset($_SESSION['account_group'])){
		if($_SESSION['account_group'] = 1){
			//let it proceed
		}else{
			header("location: ../index.php?msg=Permission denied!");
			die();	
		}
	}else{
		header("location: ../index.php?msg=Permission denied!");
		die();
	}
?>