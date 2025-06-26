<?
	$cfg['page_code'] = "download";
	include_once __DIR__."/../lib/common.php";

	$boardName = "download";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/download/";

	if($_GET['v'] != ""){
		$isDownloadMode = true;
		include_once __DIR__."/download.files.php";
	} else {
		include_once __DIR__."/../header.php";
		include_once __DIR__."/board/board.core.php";
		include_once __DIR__."/../footer.php";
	}
?>