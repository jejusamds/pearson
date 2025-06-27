<?
	include('../../../core/common.php');
	adminCheck();

	$tableName = $cfg['db']['prefix']."board_".$_POST['board'];

	$response = array();

	if($_POST['board']){
		switch($_POST['unique_check_column']){
			case "email" :
				$rs = Queryi("SELECT email FROM $tableName WHERE isDelete = 'N' AND email = ?", array(encodeData($_POST['value'])), true);
				if($rs){
					$response['is_already'] = true;
				} else {
					$response['is_already'] = false;
				}
			break;
		}
	}

	echo json_encode($response);
?>