
<?php 
	if(isset($_SESSION['username'])){
		$membersarea_tpl = new Template("styles/".$style_url."/template/membersarea_login.html");	
		$membersarea_tpl->set("mem_area_header",$language['members_area']);
		$membersarea_tpl->set("logged_in_as",$lang_m_area['logged_in_as']);
		$membersarea_tpl->set("username","<a href='showprofile.php?user=".$_SESSION['username']."'>".$_SESSION['username']."</a>");
		$membersarea_tpl->set("your_usergroup",$lang_m_area['your_group']);
		$membersarea_tpl->set("usergroup",$_SESSION['account_group_str']);
		$membersarea_tpl->set("your_userid",$lang_m_area['your_user_id']);
		$membersarea_tpl->set("userid",$_SESSION['userid']);
		$membersarea_tpl->set("userinfo",$lang_m_area['account_statistics']);
		$membersarea_tpl->set("userrank","Member");
		$membersarea_tpl->set("actions",$lang_m_area['actions']);
		if($_SESSION['account_group'] == 1){
			$membersarea_tpl->set("actionlist","<a href='admin'>".$lang_m_area['admin_control_panel']."</a><br>"."<a href='showprofile.php?user=".$_SESSION['username']."'>".$lang_m_area['view_profile']."</a><br>
		<a href='logout.php'>".$lang_m_area['log_out']."</a></p>");			
		}
		
		
				
		
		
		
	}else{
		$membersarea_tpl = new Template("styles/".$style_url."/template/membersarea.html");	
		$membersarea_tpl->set("mem_area_header",$language['members_area']);
		$membersarea_tpl->set("mem_username",$lang_m_area['username']);
		$membersarea_tpl->set("mem_password",$lang_m_area['password']);
		$membersarea_tpl->set("mem_login",$lang_m_area['login']);
		$membersarea_tpl->set("mem_or",$lang_m_area['or']);
		$membersarea_tpl->set("mem_register",$lang_m_area['register']);
		
	}
?>