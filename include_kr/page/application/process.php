<?
	include_once __DIR__."/../../../include/core/mobile_detect.php";
	include_once __DIR__."/../../../include/core/function.php";
	include_once __DIR__."/../../../include/core/config.php";
	include_once __DIR__."/../../../include/core/connect.php";

	$client_code = uniqid();

	$fileDirectory = $cfg['root'].$cfg['dir']['online_application']."/".$client_code;

	$upload_prefixes = array(
		"ceo_passport",
		"ceo_residentcard",
		"shareholder_passport",
		"shareholder_residentcard",
		"shareholder_businesslicense",
		"shareholder_list",
		"shareholder_representative_passport",
	);

	foreach($upload_prefixes as $key){
		${$key."_files"} = files_sort_to_array($key."_uploadfile");
	}

	$tableName = $cfg['db']['prefix']."online_application";

	$dataSet = "
		client_code = ?,
		select_country = ?,
		corporate_form = ?,
		company_name = ?,
		activities = ?,
		acting_address = ?,
		acting_address_text = ?,
		capital_amount = ?,
		major_phone = ?,
		acting_local_agent = ?,
		ceo_name = ?,
		ceo_phone = ?,
		ceo_email = ?,
		shareholder_pb = ?,
		shareholder_name = ?,
		shareholder_phone = ?,
		shareholder_email = ?,
		shareholder_equity = ?,
		regip = ?,
		regdate = NOW()
	";

	if(is_array($_POST['activities'])){
		$_POST['activities'] = implode("^^", $_POST['activities']);
	}

	$_POST['major_phone'][1] = "+".$_POST['major_phone_country']."-".$_POST['major_phone'][1];

	$_POST['major_phone'] = implode("^^", $_POST['major_phone']);

	$_POST['ceo_name'] = implode("^^", $_POST['ceo_name']);

	$count = count($_POST['ceo_phone']);
	for($i = 0; $i < $count; $i++){
		$_POST['ceo_phone'][$i] = "+".$_POST['ceo_phone_country'][$i]."-".$_POST['ceo_phone'][$i];
	}
	$_POST['ceo_phone'] = implode("^^", $_POST['ceo_phone']);

	$_POST['ceo_email'] = implode("^^", $_POST['ceo_email']);

	$_POST['shareholder_pb'] = implode("^^", $_POST['shareholder_pb']);

	$_POST['shareholder_name'] = implode("^^", $_POST['shareholder_name']);

	$count = count($_POST['shareholder_phone']);
	for($i = 0; $i < $count; $i++){
		$_POST['shareholder_phone'][$i] = "+".$_POST['ceo_phone_country'][$i]."-".$_POST['shareholder_phone'][$i];
	}

	$_POST['shareholder_phone'] = implode("^^", $_POST['shareholder_phone']);
	$_POST['shareholder_email'] = implode("^^", $_POST['shareholder_email']);
	$_POST['shareholder_equity'] = implode("^^", $_POST['shareholder_equity']);
	

	$params = array(
		$client_code,
		$_POST['select_country'],
		$_POST['corporate_form'],
		strtoupper($_POST['company_name']),
		$_POST['activities'],
		$_POST['acting_address'],
		$_POST['acting_address_text'],
		$_POST['capital_amount'],
		$_POST['major_phone'],
		$_POST['acting_local_agent'],
		$_POST['ceo_name'],
		$_POST['ceo_phone'],
		$_POST['ceo_email'],
		$_POST['shareholder_pb'],
		$_POST['shareholder_name'],
		$_POST['shareholder_phone'],
		$_POST['shareholder_email'],
		$_POST['shareholder_equity'],
		getIP()
	);

	// 파일 업로드
	foreach($upload_prefixes as $key){
		${$key."_stringify"} = files_to_stringify(
			${$key."_files"},
			array(
				"upload_dir" => $fileDirectory
			)
		);

		$dataSet .= ", ".$key."_upload = ?";
		if(${$key."_stringify"} != ""){
			$params[] = ${$key."_stringify"};
		} else {
			$params[] = "";
		}
	}

	$res = Queryi("INSERT INTO $tableName Set $dataSet", $params);

	if($res['isInsert']){
		$alert_msg = "신청서 제출이 완료되었습니다.";
		if($_POST['form_lang'] == "en"){
			$alert_msg = "Your application form has been submitted successfully.";
		}

		// 메일 발송
		$country = $cfg['application']['country']['kr'][$_POST['select_country']];
		$mail_msg = "Registration Date: ".date("Y-m-d H:i:s")."<hr />Company Name: ".strtoupper($_POST['company_name'])."<Br />Country: ".$country;
		sendMailToAdmin("[Online Application] 신청서가 접수되었습니다.".(($_POST['company_name'] != "") ? "(".strtoupper($_POST['company_name']).")" : ''), $mail_msg);

		alert($alert_msg, $_SERVER['HTTP_REFERER']);
	}
?>