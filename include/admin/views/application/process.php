<?php
	include '../../../core/common.php';
	adminCheck();

	$tableName = $cfg['db']['prefix']."online_application";
	$fileDirectory = $cfg['root'].$cfg['dir']['reference'];
	$where = " is_delete = 'N' ";
	$qstr = $_POST['qstr'];

	switch($_POST['mode']){
		case "delete" : 
			$where = "no = ?";

			$rs = Queryi("UPDATE $tableName SET is_delete = 'Y' WHERE $where", array($_POST['no']));

			redirectUrl("list.php?".$qstr);
		break;
	}
?>