<?php
	include('../../../core/common.php');
	adminCheck();

	if(in_array($_POST['board'], $cfg['board']['password_check_board']) && in_array($_POST['mode'], array("update", "delete"))){
		$featuresPasswordRow = Queryi("SELECT * FROM ".$cfg['db']['prefix']."admin_features WHERE code = ?", array("insights_password"), true);
		if(encodeDataForce($_POST['features_password']) != $featuresPasswordRow['val']){
			alert("비정상적인 접근입니다.");
			exit;
		}
	}

	if($_POST['board'] == "insights"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe";
	}

	if($_POST['board'] == "insights_uk_kr"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_uk_kr";
	}

	if($_POST['board'] == "insights_sg"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_sg";
	}

	if($_POST['board'] == "insights_en"){
		$subscribeTable = $cfg['db']['prefix']."board_subscribe_en";
	}

	$tableName = $cfg['db']['prefix']."board_".$_POST['board'];


	$historyTableName = $cfg['db']['prefix']."board_history";
	$fileTableName = $cfg['db']['prefix']."boardFile";

	$fileDirectory = $cfg['root'].$cfg['dir']['board']."/".$_POST['board'];

	$where = " isDelete = 'N' ";
	$qstr = $_POST['qstr'];

	$files = reArrayFiles();

	$dataSet = "category = ?,
					subject = ?,
					link = ?,
					email = ?,
					content = ?,
					tmp1 = ?,
					tmp2 = ?,
					tmp3 = ?,
					tmp4 = ?,
					tmp5 = ?,
					tmp6 = ?,
					tmp7 = ?,
					tmp8 = ?,
					tmp9 = ?,
					tmp10 = ?
				";

	$historyDataSet = "
		action = ?,
		user_id = ?,
		board_name = ?,
		board_no = ?,
		update_date = NOW(),
		update_ip = ?
	";

	if($_POST['link'] != "" && in_array($_POST['board'], $cfg['youtubeLinkBoard'])){
		$search = '#(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12})#x';
		preg_match_all($search, $_POST['link'], $matches);
		$_POST['link'] = 'https://www.youtube.com/embed/'.$matches[1][0];
	}

	if($_POST['board'] == "insights" || $_POST['board'] == "insights_sg" || $_POST['board'] == "insights_en" || $_POST['board'] == "testimonials_en" || $_POST['board'] == "insights_uk_kr"){
		$_POST['category'] = @implode(",", $_POST['category']);
	}

	if(in_array($_POST['board'], array("subscribe", "subscribe_en", "subscribe_sg"))){
		$_POST['email'] = encodeData($_POST['email']);
	}

	$params = array(
		$_POST['category'], 
		$_POST['subject'], 
		$_POST['link'], 
		$_POST['email'], 
		$_POST['content'], 
		$_POST['tmp1'], 
		$_POST['tmp2'], 
		$_POST['tmp3'], 
		$_POST['tmp4'], 
		$_POST['tmp5'], 
		$_POST['tmp6'], 
		$_POST['tmp7'], 
		$_POST['tmp8'], 
		$_POST['tmp9'], 
		$_POST['tmp10']
	);

	if($_POST['isNotice'] != ""){
		$dataSet .= " , isNotice = ?";
		$params[] = $_POST['isNotice'];
	} else {
		$dataSet .= " , isNotice = ?";
		$params[] = 'N';
	}

	if($_POST['isSecret'] != ""){
		$dataSet .= " , isSecret = ?";
		$params[] = $_POST['isSecret'];
	} else {
		$dataSet .= " , isSecret = ?";
		$params[] = 'N';
	}


	switch($_POST['mode']){
		case "create" : 
			$dataSet .= ", name = ?, id = ?, password = ?, regDate = NOW(), regip = ?";
			$params[] = $_POST['name'];
			$params[] = $_POST['userid'];
			$params[] = md5($_POST['password']);
			$params[] = getIP();

			// 고유 주소 생성
			if(in_array($_POST['board'], $cfg['board']['permalink_table'])){
				$dataSet .= ", permalink = ?";
				$params[] = getPermalink($_POST['subject']);
			}

			if(in_array($_POST['board'], $cfg['board']['meta_table'])){
				$dataSet .= ", meta_title = ?, meta_description = ?";
				$params[] = $_POST['meta_title'];
				$params[] = $_POST['meta_description'];
			}

			$rs = Queryi("INSERT INTO $tableName SET $dataSet", $params);

			if(count($files) != 0){
				for($i = 0; $i < count($files); $i++){
					$data = $files[$i];
					if($data['name'] != ""){
						$createdFileName = boardFileUpload($fileTableName, $data, $fileDirectory, $_POST['board'], $rs['lastInsertId'], $i + 1);
						if($subscribeTable != "" && $i + 1 == 4){
							$subscribeFileName = $createdFileName;
						}
					}
					if(isset($cfg['board']['thumbnail'][$_POST['board']][$i])){
						createThumb($fileDirectory, $createdFileName, $cfg['board']['thumbnail'][$_POST['board']][$i]['width'], $cfg['board']['thumbnail'][$_POST['board']][$i]['height']);	
					}
				}
			}

			// 구독 메일 발송
			if($subscribeTable != "" && $_POST['tmp10'] == "Y"){
				$sc_res = Queryi("SELECT * FROM $subscribeTable WHERE isDelete = 'N'");

				if(count($sc_res) > 0){
					require_once __DIR__."/../../../core/PHPMailer/PHPMailerAutoload.php";

					switch($_POST['board']){
						case "insights" :
							$lang_bbs = "ko";
						break;
						case "insights_sg" :
							$lang_bbs = "sg";
						break;
						case "insights_en" :
							$lang_bbs = "en";
						break;
						case "insights_uk_kr" :
							$lang_bbs = "uk_kr";
						break;
					}
					switch($lang_bbs){
						case "ko" :
							$domain = "https://pearsonp.com";
							$email_from = "info@pearsonp.com";
							$email_passwd = "How18604";
							$baseImagePath = $cfg['root']."/include/images/newsletter/ko";
							$innerImgs = array(
								"read_the_full_article.png" => "READ THE FULL ARTICLE",
								"visit_our_website.png" => "VISIT OUR WEBSITE",
								"pearson_and_partners.png" => "Pearson & Partners"
							);
							$contact_info = '<p style="font-family: Arial, Helvetica; color: rgba(255, 255, 255, 0.5); margin: 0; padding: 0;">서울특별시 강남구 테헤란로 431 저스트코타워<br /><br />TEL : 02-6952-7579<br />E-Mail : <a href="mailto:info@pearsonp.com" style="color: rgba(255, 255, 255, 0.5); text-decoration: none;">info@pearsonp.com</a></p>';
							$subscribeCancelURL = "#";
						break;
						case "sg" :
							$domain = "https://pearsonkorea.com";
							$email_from = "info@pearsonkorea.com";
							$email_passwd = "Kug84339";
							$baseImagePath = $cfg['root']."/include/images/newsletter/sg";
							$innerImgs = array(
								"read_the_full_article.png" => "READ THE FULL ARTICLE",
								"visit_our_website.png" => "VISIT OUR WEBSITE",
								"pearson_and_partners.png" => "Pearson & Partners"
							);
							$contact_info = '<p style="font-family: Arial, Helvetica; color: rgba(255, 255, 255, 0.5); margin: 0; padding: 0;">Address : 431 Teheran Road Gangnam Seoul, South Korea<br />TEL : +82-2-6956-7872, +1-877-277-2924<br />E-Mail : <a href="mailto:info@pearsonkorea.com" style="color: rgba(255, 255, 255, 0.5); text-decoration: none;">info@pearsonkorea.com</a></p>';

						break;
						case "en" :
							$domain = "https://pearsonsingapore.com";
							$email_from = "info@pearsonsingapore.com";
							$email_passwd = "Wop59169";
							$baseImagePath = $cfg['root']."/include/images/newsletter/en";
							$contact_info = '<p style="font-family: Arial, Helvetica; color: rgba(255, 255, 255, 0.5); margin: 0; padding: 0;">Address : 77 Robinson Road, #34-01, Singapore 068896<br />TEL : +65 6809 2116<br />E-Mail : <a href="mailto:info@pearsonsingapore.com" style="color: rgba(255, 255, 255, 0.5); text-decoration: none;">info@pearsonsingapore.com</a></p>';
							$innerImgs = array(
								"read_the_full_article.png" => "READ THE FULL ARTICLE",
								"visit_our_website.png" => "VISIT OUR WEBSITE",
								"pearson_and_partners.png" => "Pearson & Partners"
							);
							$subscribeCancelURL = "#";
						break;
						case "uk_kr" :
							$domain = "https://pearsonp.co.kr";
							$email_from = "info@pearsonp.co.kr";
							$email_passwd = "How18604";
							$baseImagePath = $cfg['root']."/include/images/newsletter/uk_kr";
							$innerImgs = array(
								"read_the_full_article.png" => "READ THE FULL ARTICLE",
								"visit_our_website.png" => "VISIT OUR WEBSITE",
								"pearson_and_partners.png" => "Pearson & Partners"
							);
							$contact_info = '<p style="font-family: Arial, Helvetica; color: rgba(255, 255, 255, 0.5); margin: 0; padding: 0;">서울특별시 강남구 테헤란로 431 저스트코타워<br /><br />TEL : 02-6952-7579<br />E-Mail : <a href="mailto:info@pearsonp.co.kr" style="color: rgba(255, 255, 255, 0.5); text-decoration: none;">info@pearsonp.co.kr</a></p>';
							$subscribeCancelURL = "#";
						break;
					}

					$row['subject'] = $_POST['subject'];
					$row['permalink'] = getPermalink($_POST['subject']);
					$row['content'] = $_POST['content'];
					$row['regDate'] = date("Y-m-d H:i:s");

					$stmpContent = embeddedNewsletterContent($row['content']);

					$mail = new PHPMailer(true);
					$mail->IsSMTP();
					$mail->Mailer = "smtp";
					$mail->CharSet = "UTF-8"; 
					$mail->ContentType = "text/html";
					$mail->Host = "smtp.office365.com";
					$mail->SMTPAuth = true;
					$mail->Username = $email_from;
					$mail->Password = $email_passwd;

					$mail->SMTPSecure = "tls";
					$mail->Port = "587";

					for($i = 0; $i < count($stmpContent['cid']); $i++){
						$cid_data = $stmpContent['cid'][$i];

						$mail->AddEmbeddedImage($cid_data['src'], $cid_data['idx'], "", "base64", "image/png");
					}

					$mi = 1;
					foreach($innerImgs as $name => $alt){
						$mail->AddEmbeddedImage($baseImagePath."/".$name, "pap_mailing_inner_img_final_".$mi, $alt, "base64", "image/png");
						$mi++;
					}

					$mail->SetFrom($email_from, "Pearson Newsletter");
					$mail->isHTML(true);
					$mail->Subject = $row['subject'];

					if($subscribeFileName != ""){
						$mail->AddAttachment($fileDirectory."/".$subscribeFileName, $_FILES['uploadfile4']['name']);
					}

					for($k = 0; $k < count($sc_res); $k++){
						ob_start();
						switch($lang_bbs){
							case "ko" :
								$subscribeCancelURL = "https://pearsonp.com/subscribe.cancel/?e=".$sc_res[$k]['email']."&token=".$sc_res[$k]['tmp10'];
								include 'newsletter/mail.form.ko.html';
							break;
							case "sg" :
								$subscribeCancelURL = "https://pearsonkorea.com/subscribe.cancel/?e=".$sc_res[$k]['email']."&token=".$sc_res[$k]['tmp10'];
								include 'newsletter/mail.form.sg.html';
							break;
							case "en" :
								$subscribeCancelURL = "https://pearsonsingapore.com/subscribe.cancel/?e=".$sc_res[$k]['email']."&token=".$sc_res[$k]['tmp10'];
								include 'newsletter/mail.form.en.html';
							break;
							case "uk_kr" :
								$subscribeCancelURL = "https://pearsonp.com/uk/subscribe.cancel/?e=".$sc_res[$k]['email']."&token=".$sc_res[$k]['tmp10'];
								include 'newsletter/mail.form.ko.html';
							break;
						}
			
						$email_message = ob_get_contents();
						ob_end_clean();

						$mail->AddAddress(decodeData($sc_res[$k]['email']), "subscriber");
						$mail->Body = $email_message;
						$mail->Send();
						$mail->clearAddresses();
					}
				}
			}
			// 구독 메일 발송

			// Histroy
			Queryi("INSERT INTO $historyTableName SET $historyDataSet", array("insert", $_SESSION['userid'], $_POST['board'], "", getIP()));

			redirectUrl("board_list.php?board=".$_POST['board']);

			break;
		case "update" : 
			if($_POST['password']){
				$password = md5($_POST['password']);
				$dataSet .= ", password = ? ";
				$params[] = $password;
			}

			if(($_POST['board'] == "insights_sg" || $_POST['board'] == "insights_en" || $_POST['board'] == "testimonials_en" || $_POST['board'] == "insights" || $_POST['board'] == "insights_uk_kr") && $_POST['regDate'] != ""){
				$dataSet .= ", regDate = ? ";
				$params[] = $_POST['regDate'];
			}

			$dataSet .= ", modifyDate = NOW(), modifyip = ?";		
			$params[] = getIP();

			if($_POST['permalink'] != ""){
				$isUniquePermalink = Queryi("SELECT * FROM $tableName WHERE isDelete = 'N' AND permalink = ? AND no != ?", array($_POST['permalink'], $_POST['no']), true);

				if(count($isUniquePermalink) > 0){
					alert("중복된 고유 주소가 있습니다.");
					exit;
				} else {
					$dataSet .= ", permalink = ?";
					$params[] = $_POST['permalink'];
				}
			}

			if($_POST['meta_title'] != ""){
				$dataSet .= ", meta_title = ?";
				$params[] = $_POST['meta_title'];
			}

			if($_POST['meta_description'] != ""){
				$dataSet .= ", meta_description = ?";
				$params[] = $_POST['meta_description'];
			}

			$where = " no = ? ";
			$params[] = $_POST['no'];



			$rs = Queryi("UPDATE $tableName SET $dataSet WHERE $where", $params);
			if($rs['isSuccess']){
				$resortDatas = $_POST['fileseq'];

				$clearDataQuery = "SELECT * FROM $fileTableName WHERE board = ? and tno = ?";

				if(count(@array_filter($resortDatas)) > 0){
					$clearDataQuery .= " and no NOT IN(".implode(",", array_filter($resortDatas)).")";
				}
				$clearDataQuery .= " ORDER BY seq ASC";

				$clearDatas = Queryi($clearDataQuery, array($_POST['board'], $_POST['no']));

				// 삭제 파일데이터 처리
				if(count($clearDatas) > 0){
					foreach($clearDatas as $clearData){
						fileDelete($fileTableName, $fileDirectory, $clearData['no']);
					}
				}

				// 파일데이터 재정렬
				if(count($resortDatas) > 0){
					for($i = 0; $i < count($resortDatas); $i++){
						if($resortDatas[$i] != ""){
							Queryi("UPDATE $fileTableName SET seq = ? WHERE no = ?", array($i + 1, $resortDatas[$i]));
						}
					}
				}

				// 파일데이터 추가 및 수정 처리
				if(count($files) > 0){
					for($i = 0; $i < count($files); $i++){
						$data = $files[$i];
						if($data['name'] != ""){
							$createdFileName = boardFileUpload($fileTableName, $data, $fileDirectory, $_POST['board'], $_POST['no'], $i + 1);

							if(isset($cfg['board']['thumbnail'][$_POST['board']][$i])){
								createThumb($fileDirectory, $createdFileName, $cfg['board']['thumbnail'][$_POST['board']][$i]['width'], $cfg['board']['thumbnail'][$_POST['board']][$i]['height']);	
							}
						}
					}
				}

				// Histroy
				Queryi("INSERT INTO $historyTableName SET $historyDataSet", array("update", $_SESSION['userid'], $_POST['board'], $_POST['no'], getIP()));

				redirectUrl("board_list.php?".$qstr);
			}
			break;
		case "delete" : 
			if($_SESSION['userLevel'] > 100){
				$where = "no = ?";

				$rs = Queryi("UPDATE $tableName SET isDelete = 'Y' WHERE $where", array($_POST['no']));

				// Histroy
				Queryi("INSERT INTO $historyTableName SET $historyDataSet", array("delete", $_SESSION['userid'], $_POST['board'], $_POST['no'], getIP()));

				redirectUrl("board_list.php?".$qstr);
			}
			break;
	}
?>