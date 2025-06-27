<?php
	include_once "include/core/mobile_detect.php";

	$detect_tmp = new Mobile_Detect;

	$isMobile = $detect_tmp->isMobile();
	$isTablet = $detect_tmp->isTablet();
	$isiPad = $detect_tmp->isiPad();



	if($isMobile && strpos($_SERVER['REQUEST_URI'], "/rss/") === false){
		header("Location: /mobile/");
	} else {
		if(strpos($_SERVER['SERVER_NAME'], "pearsonkorea.com") !== false){
			include_once "include_sg/page/main.php";
		} elseif(strpos($_SERVER['SERVER_NAME'], "pearsonp.com") !== false || strpos($_SERVER['SERVER_NAME'], "pearsonp.co.kr") !== false){
			include_once "include_kr/page/main.php";
		} else {
			include_once "include_en/page/main.php";
		}
	}
?>
