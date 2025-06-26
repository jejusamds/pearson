<?
	include_once __DIR__."/../lib/common.php";

	$boardName = "subscribe";
	$tableName = $cfg['db']['prefix']."board_".$boardName;

	$data = array(
		'secret' => "6LedXKMUAAAAALgOFkWK2i0BLkF9M1QXOSnZlFMa",
		'response' => $_POST['subscribe_token']
	);

	$verify = curl_init();
	curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($verify, CURLOPT_POST, true);
	curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($verify);
	$response = get_object_vars(json_decode($response));

	if(!$response['success'] && $response['error-codes'][0] != 'timeout-or-duplicate'){
		alert($response['error-codes'][0], $cfg['href']);
	} elseif(domainCheck()){
		$already = Queryi("SELECT * FROM $tableName WHERE isDelete = 'N' AND email = ?", array(encodeData($_POST['sc_mail'])), true);

		if(!$already){
			$dataSet = "
				email = ?,
				tmp10 = ?,
				regip = ?,
				regDate = NOW()
			";

			$params = array(
				encodeData($_POST['sc_mail']),
				createToken(),
				getIP()
			);

			$res = Queryi("INSERT INTO $tableName SET $dataSet", $params);
			
			if($res['isInsert']){
				alert("구독 완료 되었습니다. 향후 인사이트글을 이메일로 받아보실 수 있습니다.", $_SERVER['HTTP_REFERER']);
			}
		} else {
			alert("이미 구독 중입니다.", $_SERVER['HTTP_REFERER']);
		}
	}
?>