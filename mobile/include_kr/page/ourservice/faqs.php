<?
	include_once __DIR__."/../../lib/common.php";
	$cfg['page_code'] = "ourservice/faqs";
	$boardName = "faq";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/ourservice/faqs/";

?>
<? include_once __DIR__."/../../header.php"; ?>
<? include_once __DIR__."/../board/board.core.php"; ?>
<? include_once __DIR__."/../../footer.php"; ?>
