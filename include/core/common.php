<?php
	@ini_set('memory_limit','-1');
	@header("content-type:text/html; charset=utf-8");
	@session_start();

	// 오픈안된 사이트들은 지정한 언어로 접속하도록 설정
	switch(str_replace("www.", "", $_SERVER['SERVER_NAME'])){
		case "pearsonp.co.kr" :
		case "pearsonp.com" :
			$public_select_language = "kr";
		break;
		case "pearsonkorea.com" :
			$public_select_language = "sg";
		break;
		case "pearsonsingapore.com" :
			$public_select_language = "en";
		break;
	}
    

	include_once __DIR__."/mobile_detect.php";
	include_once __DIR__."/function.php";
	include_once __DIR__."/config.php";
    
	if($isMobile && $_SESSION[md5('pap_pc_mode')] != "on" && strpos($_SERVER['REQUEST_URI'], "/application/") === false && strpos($_SERVER['REQUEST_URI'], "/rss/") === false && strpos($_SERVER['REQUEST_URI'], "/mobile/") === false){
		header("Location: /mobile".$_SERVER['REQUEST_URI']);
	} elseif(!$isMobile && strpos($_SERVER['REQUEST_URI'], "/application/") === false && strpos($_SERVER['REQUEST_URI'], "/rss/") === false && strpos($_SERVER['REQUEST_URI'], "/mobile/") !== false){
		header("Location: /".str_replace("/mobile/", "", $_SERVER['REQUEST_URI']));
	}

	include_once __DIR__."/connect.php";

	if(!checkAccessIP()){
		exit;
	}
?>
