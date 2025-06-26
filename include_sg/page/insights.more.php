<?
	$cfg['page_code'] = "insights";
	include_once __DIR__."/../lib/common.php";

	$boardName = "insights_sg";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/insights/";
	$isAsync = true;

	include_once __DIR__."/board/board.core.php";
?>