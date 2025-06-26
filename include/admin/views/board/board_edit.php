<?php
	
    include_once "../../../core/common.php";
	adminCheck();

    

	if($_GET['board'] == "insights"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe";
	}

	if($_GET['board'] == "insights_uk_kr"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_uk_kr";
	}

	if($_GET['board'] == "insights_sg"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_sg";
	}

	if($_GET['board'] == "insights_en"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_en";
	}

	$tableName = $cfg['db']['prefix']."board_".$_GET['board'];
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$fileDirectory = "upload/".$_GET['board']."/";

	if($_GET['mode'] == "update"){
		$rs = Queryi("SELECT * FROM $tableName WHERE no = ?", array($_GET['no']));
		$fileRs = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? ORDER BY seq ASC", array($_GET['board'], $rs[0]['no']));

		$fileCount = count($fileRs);

		if($fileCount > 0){
			for($i = 0; $i < $fileCount; $i++){
				$rs[0]['uploads'][$fileRs[$i]['seq']-1] = $fileRs[$i];

				if($fileLastSeq < $fileRs[$i]['seq']){
					$fileLastSeq = $fileRs[$i]['seq'];
				}
			}
		} else {
			$fileCount = 1;
			$fileLastSeq = 1;
		}

		$rs[0]['subject'] = htmlspecialchars($rs[0]['subject']);
	} else {
		$rs[0]['id'] = $_SESSION['userid'];
		$rs[0]['name'] = $_SESSION['userName'];
		$fileCount = 1;
		$fileLastSeq = 1;
		$rs[0]['regDate'] = date("Y-m-d H:i:s");

		if($_GET['board'] == "insights" || $_GET['board'] == "insights_sg" || $_GET['board'] == "insights_en" || $_GET['board'] == "insights_uk_kr"){
			$subscribe = Queryi("SELECT count(*) as cnt FROM $subscribeTable WHERE isDelete = 'N'", array(), true);
		}
	}

	$qstr = getQstr($cfg['board']['qstr'][$_GET['board']], $_GET)."&page=".$_GET['page'];

	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_header.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_navi.php";
	include_once "template/".$_GET['board']."/edit.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_footer.php";
?>