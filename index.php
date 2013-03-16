<?php
	/* 
		WELCOME TO MyPageSys SOURCE CODE
		MyPageSys php files are pure php and you can find style and template files from styles/stylename/template/
		MyPageSys includes as default 2 languages(for now), english and finnish. Source and comments are in english.
	*/
?>

<?php 
	//adding some stuff
	require "init.php";
	require "scripts/update_online_users.php";
	require "scripts/visitors.php";
	require "lang/fi/main.php";
	include "files/template.class.php"; //if this file is not included, templates wont work at all!	
	
	//initializing templates
	$main_tpl = new MPSTemplate("styles/".$style_url."/template/main.html");
	
	$navbar_tpl = new MPSTemplate("styles/".$style_url."/template/navbar.html");	
	$footer_tpl = new MPSTemplate("styles/".$style_url."/template/footer.html");	
	
	
	
	//page scripts
	include "navbar_showlinks.php";
	include "scripts/showcontent.php";
	include "membersarea.php";
	include "scripts/visitors.php";
	include "scripts/update_online_users.php";
	include "scripts/show_online_users.php";
	
	//starting up the header (html code can be modified from styles/stylename/template/header.html!)
	$header_tpl = new MPSTemplate("styles/".$style_url."/template/header.html");
	
	////// SELECTING RANDOM HEADER IMAGE.. THIS IS CUSTOM STUFF ;) ////// 
	$image = rand(1,4);
	if($image == 1){
		$img = "http://kuvauppi.fi/view/output/GUID/CB86F344-8EAE-DE49-3714-A7C4F234D6AD/size/default/logo4.png"; 
	}elseif($image == 2){
		$img = "http://kuvauppi.fi/view/output/GUID/38D9F913-2C30-4237-AFD6-86963E77DC20/size/default/logo1.png";
	}elseif($image == 3){
		$img = "http://kuvauppi.fi/view/output/GUID/2C083187-FC0D-5896-448F-6C53474DE8BE/size/default/logo2.png";
	}elseif($image == 4){
		$img = "http://kuvauppi.fi/view/output/GUID/D1CF7AF5-E6BE-167F-F5BF-6D0E30AA26CA/size/default/logo3.png";
	}
	////// ////// ////// 
	
	//setting template variables
	$header_tpl->set("img_url",$img);
	$header_tpl->set("search_text",$language['search']);
	
	
	$footer_tpl->set("footertext",$page_author);
	
	//main template
	
	$main_tpl->set("page_title",$page_title);
	$main_tpl->set("style_url","styles/".$style_url."/main.css");
	$main_tpl->set("site_description", $page_description);
	$main_tpl->set("site_keywords", $page_keywords);
	$main_tpl->set("site_author", $page_author);
	$main_tpl->set("navbar", $navbar_tpl->output());
	$main_tpl->set("header", $header_tpl->output());
	$main_tpl->set("footer", $footer_tpl->output());
	$main_tpl->set("content", $content_tpl->output());
	$main_tpl->set("who_is_online", $vc_tpl->output());
	$main_tpl->set("search_text",$language['search']);
	$main_tpl->set("membersarea", $membersarea_tpl->output());
	$c_p_title = "";
	echo $main_tpl->output(); //finally printing the full page out :)
	
	//AS YOU CAN SEE, THERE'S STUPID HTML CODE STILL DOWN THERE AND IT SHOULD BE REPLACED WITH NICE TPL SYSTEM ;)
?>
