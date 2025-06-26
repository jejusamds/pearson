<?
	include_once __DIR__."/../lib/common.php";

	$boardName = "subscribe_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;

	$params = array(
		$_GET['e'],
		$_GET['token']
	);

	$isSubscriber = Queryi("SELECT * FROM $tableName WHERE email = ? AND tmp10 = ?", $params, true);

	if($isSubscriber){
		if($isSubscriber['isDelete'] == 'Y'){
			alert("Your subscription has already been canceled.", "close");
		} else {
			$res = Queryi("UPDATE $tableName SET isDelete = 'Y', tmp9 = NOW() WHERE email = ? AND tmp10 = ?", $params, true);
			if($res){
				alert("You have successfully unsubscribed.", "close");
			} else {
				alert('Failed to cancel subscription.\nPlease contact your administrator if you continue to experience any problems.', "close");
			}
		}
	} else {
		alert("Abnormal approach.", "close");
	}
?>