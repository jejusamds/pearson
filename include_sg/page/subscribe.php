<?
	include_once __DIR__."/../lib/common.php";

	$boardName = "subscribe_sg";
	$tableName = $cfg['db']['prefix']."board_".$boardName;

	$data = array(
		'secret' => "6LekXKMUAAAAAOBzCgi1-8oW0xnLpKPSU0qYfuvo",
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
				alert("Thank you. We will send our insights articles to the address provided.", $_SERVER['HTTP_REFERER']);
			}
		} else {
			alert("This email is already subscribed.", $_SERVER['HTTP_REFERER']);
		}
	}
?>