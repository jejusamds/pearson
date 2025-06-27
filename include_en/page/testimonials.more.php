<?
	$cfg['page_code'] = "testimonials";
	include_once __DIR__."/../lib/common.php";

	$boardName = "testimonials_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/testimonials/";
	$isAsync = true;

	setcookie('pap_async_testimonials_en_paging', $_GET['page'], time() + 86400, "/", $_SERVER["SERVER_NAME"]);

	include_once __DIR__."/board/board.core.php";
?>