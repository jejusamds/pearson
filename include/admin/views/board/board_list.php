<?php
	include_once "../../../core/common.php";
	adminCheck();

	$tableName = $cfg['db']['prefix']."board_".$_GET['board'];
        $fileTableName = $cfg['db']['prefix']."boardFile";
        $introTableName = $cfg['db']['prefix']."board_intro";
	$fileDirectory = $cfg['dir']['board']."/".$_GET['board']."/";
	$where = "isDelete = 'N'";
	$params = array();
	$orderBy = " ORDER BY ";

	$pagingItemMax = (isset($cfg['board']['adminPaging'][$_GET['board']]) ? $cfg['board']['adminPaging'][$_GET['board']]['itemMax'] : $cfg['board']['adminPaging']['default']['itemMax']);
	$pagingBlockMax = (isset($cfg['board']['adminPaging'][$_GET['board']]) ? $cfg['board']['adminPaging'][$_GET['board']]['blockMax'] : $cfg['board']['adminPaging']['default']['blockMax']);

	if(isset($cfg['board']['search'][$_GET['board']]) && count($cfg['board']['search'][$_GET['board']]) > 0){
		foreach($cfg['board']['search'][$_GET['board']] as $key => $value){
			if($_GET[$key] != ""){
				$params[] = "%".$_GET[$key]."%";
				$where .= " and $key like ? ";
			}
		}
	}

	if($_GET['regDateStart'] != "" && $_GET['regDateEnd'] != ""){
		$params[] = $_GET['regDateStart'];
		$params[] = date("Y-m-d", strtotime($_GET['regDateEnd']." +1 day"));
		$where .= " and (regDate >= ? and regDate <= ?) ";
	}

	if(in_array($_GET['board'], array("subscribe", "subscribe_sg", "subscribe_en"))){
		if($_GET['search'] != ""){
			$params[] = '%'.$_GET['search'].'%';
			$params[] = '%'.$_GET['search'].'%';
			$params[] = '%'.$_GET['search'].'%';

			$where .= " and (subject like ? or content like ? or AES_DECRYPT(UNHEX(email), '".$cfg['public_key']."') like ?) ";
		}
	} else {
		if($_GET['search'] != ""){
			$params[] = '%'.$_GET['search'].'%';
			$params[] = '%'.$_GET['search'].'%';
			$where .= " and (subject like ? or content like ?) ";
		}
	}

	$orderBy .= "regDate DESC";
	
	
	$rs = Queryi("SELECT COUNT(*) as Cnt FROM $tableName WHERE $where", $params);
	$dataCount = $rs[0]['Cnt'];
	if($dataCount > 0){
		$pageTotal  = ceil($dataCount / $pagingItemMax);
		if ($_GET['page'] == ""){ $_GET['page'] = 1; }
		$fromLimit = ($_GET['page'] - 1) * $pagingItemMax;

		$rs = Queryi("SELECT * FROM $tableName WHERE $where $orderBy LIMIT $fromLimit, ".$pagingItemMax, $params);
		$fileStmt = $mysqli->prepare("SELECT * FROM $fileTableName WHERE board = :board and tno = :tno ORDER BY seq ASC");

		$fileStmt->bindParam(":board", $_GET['board']);
		$fileStmt->bindParam(":tno", $tmpNo);
		for($i = 0; $i < count($rs); $i++){
			$tmpNo = $rs[$i]['no'];
			$fileStmt->execute();
			$rs[$i]['uploads'] = $fileStmt->fetchAll(PDO::FETCH_ASSOC);
			if($rs[$i]['uploads']){
				for($k = 0; $k < count($rs[$i]['uploads']); $k++){
					$rs[$i]['images'][$k]['src'] = $fileDirectory."/".$rs[$i]['uploads'][$k]['saveName'];
					$rs[$i]['images'][$k]['thumbnail'] = $fileDirectory."/thumbnail/thumbnail_".$rs[$i]['uploads'][$k]['saveName'];
					$rs[$i]['images'][$k]['alt'] = $fileDirectory."/".$rs[$i]['uploads'][$k]['realName'];
				}
			} else {
				$rs[$i]['images'][0]['src'] = $cfg['libUrl']."/images/no_image.png";
				$rs[$i]['images'][0]['thumbnail'] = $cfg['libUrl']."/images/no_image.png";
				$rs[$i]['images'][0]['alt'] = "No Image !";
			}

			if(trim($rs[$i]['subject']) == ""){
				$rs[$i]['subject'] = "#";
			}
		}
	} else {
		$rs = array();
	}

        $introRow = Queryi("SELECT * FROM $introTableName WHERE board = ?", array($_GET['board']), true);
        $introText = $introRow['content'];

        $qstr = getQstr($cfg['board']['qstr'][$_GET['board']], $_GET)."&page=";

	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_header.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_navi.php";
	include_once "template/".$_GET['board']."/list.php"; 
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_footer.php";	
?>