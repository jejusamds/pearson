<?
	$cfg['page_code'] = "testimonials";
	include_once __DIR__."/../lib/common.php";

	$boardName = "testimonials_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/testimonials/";

	setcookie(md5("pap_cki_".$boardName."_mobile_referer"), $_SERVER['REQUEST_URI'], time() + 86400, "/", $_SERVER["SERVER_NAME"]);

	if($_GET['cc'] == "clear"){
		setcookie('pap_async_testimonials_en_mobile_paging', null, -1, "/", $_SERVER["SERVER_NAME"]);
		header("Location: ".$cfg['href']."/testimonials/".(($_GET['v'] != "") ? '?v='.$_GET['v'] : '').(($_GET['c'] != "") ? (($_GET['v'] != "") ? '&' : '?').'c='.$_GET['c'] : ''));
	}

	if($_GET['v'] == ""){
		if($boardName == "testimonials_en" && strpos($_COOKIE[md5("pap_cki_".$boardName."_mobile_referer")], "/testimonials/?v=") !== false){
			if(!$_COOKIE['pap_async_testimonials_en_mobile_paging']){
				if ($_GET['page'] == ""){ $_GET['page'] = 1; }
			} else {
				$_GET['page'] = $_COOKIE['pap_async_testimonials_en_mobile_paging'];
				$asyncLimit = true;
			}
		} else {
			if ($_GET['page'] == ""){ $_GET['page'] = 1; }
		}
	}

	include_once __DIR__."/../header.php";
	include_once __DIR__."/board/board.core.php";
	include_once __DIR__."/../footer.php";
?>