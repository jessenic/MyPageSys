<?php 
    if(!isset($use_phpbb_sessions)){
        include("../init.php");   
    }
    if($use_phpbb_sessions && $auth->acl_get('a_')){
            //let it proceed
    }elseif(!$ue_phpbb_sessions && isset($_SESSION['username']) && isset($_SESSION['account_group']) && $_SESSION['account_group'] = 1){
			//let it proceed
	}else{
		header("location: ../index.php?msg=Permission denied!");
		die();
	}
?>