<?
	include_once __DIR__."/../lib/common.php";

	$boardName = "subscribe_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;

	$params = array(
		$_GET['e'],
		$_GET['token']
	);

	$res = Queryi("UPDATE $tableName SET isDelete = 'Y', tmp9 = NOW() WHERE email = ? AND tmp10 = ?", $params, true);
	
	if(count($res) > 0){
		alert("You have successfully unsubscribed.", "close");
	} else {
		alert("Abnormal approach.", "close");
	}
?>