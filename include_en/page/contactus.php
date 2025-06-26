<?


	$cfg['page_code'] = "contactus";
	include_once __DIR__."/../lib/common.php";

	$boardName = "inquiry_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/contactus/";

	if($_POST['mode'] == "inq"){
		$data = array(
			'secret' => "6Lfmq58UAAAAAGDtoEiD2WMB4-uMeXzV2PxOm3v0",
			'response' => $_POST['contact_token']
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
			// 자동으로 구독자 등록
			if($_POST['cp_email'] && strpos($_POST['cp_email'], "@") !== false){
				$alreadySubscribe = Queryi("SELECT email FROM ".$cfg['db']['prefix']."board_subscribe_en WHERE isDelete = 'N' AND email = ?", array(encodeData($_POST['cp_email'])), true);

				if(!$alreadySubscribe){
					$ssDataSet = "
						email = ?,
						tmp10 = ?,
						regip = ?,
						regDate = NOW()
					";

					$ssParams = array(
						encodeData($_POST['cp_email']),
						createToken(),
						getIP()
					);

					Queryi("INSERT INTO ".$cfg['db']['prefix']."board_subscribe_en SET $ssDataSet", $ssParams);
				}
			}

			$dataSet = "
				name = ?,
				tmp1 = ?,
				email = ?,
				category = ?,
				subject = ?,
				content = ?,
				regip = ?,
				regDate = NOW()
			";

			$params = array(
				$_POST['cp_name'],
				encodeData($_POST['cp_phone']),
				encodeData($_POST['cp_email']),
				$_POST['cp_type'],
				$_POST['cp_title'],
				$_POST['cp_content'],
				getIP()
			);

			$res = Queryi("INSERT INTO $tableName SET $dataSet", $params);

			include_once __DIR__."/../lib/PHPMailer/PHPMailerAutoload.php";
			if($res['isInsert']){
				$email_subject = "[Pearson & Partners] Inquiry ".(($_POST['cp_name'] != "" || $_POST['cp_phone'] != "") ? '(' : '').$_POST['cp_name'].(($_POST['cp_name'] != "") ? ", ".$_POST['cp_phone'] : $_POST['cp_phone']).(($_POST['cp_name'] != "" || $_POST['cp_phone'] != "") ? ')' : '');
				$email_message = "<hr /><br />";
				$email_message .= "<b>Name :</b> ".$_POST['cp_name']."<br /><br />";
				$email_message .= "<b>Phone :</b> ".$_POST['cp_phone']."<br /><br />";
				$email_message .= "<b>E-mail :</b> ".$_POST['cp_email']."<br /><br />";
				$email_message .= "<hr /><br />";
				$email_message .= "<b>TYPE :</b> ".$cfg['board']['category'][$boardName][$_POST['cp_type']]."<br /><br />";
				$email_message .= "<b>Title :</b> ".$_POST['cp_title']."<br /><br />";
				$email_message .= "<b>Message :</b> <br />".nl2br($_POST['cp_content']);
				$email_message .= "<br /><br /><hr />";

				$mail = new PHPMailer();
				 
				$mail->IsSMTP();
				 
				$mail->Mailer = "smtp";
				$mail->CharSet = "UTF-8"; 

				$mail->SetFrom($_POST['cp_email'], $_POST['cp_name']);

				$mail->AddAddress("justin@pearsonp.com");

				$mail->WordWrap = 50;
				$mail->IsHTML(true);
				 
				$mail->Subject = $email_subject;
				$mail->Body = $email_message;
				$mail->send();

				alert("Thank you. We will get in touch with you shortly.", $_SERVER['HTTP_REFERER']);
			}
		}
	}

	include_once __DIR__."/../header.php";
?>
	<div class="sub_content_wrap">
		<div class="sub_content_box">
			<div class="sub_box">
				<div class="sub_loc">
					<div class="location">
						<span>HOME</span>
						<i></i>
						<span>contact us</span>
					</div>
				</div>
				<p class="sub_title ty02">contact us</p>
				<div class="whywrap contact event">
					<p class="title ty02">Location</p>
					<div class="map_wrap">
		  				<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8261913713827!2d103.84620281586871!3d1.2777742621559853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19124fd98a39%3A0x1dd9f43a04b11e38!2zNzcgUm9iaW5zb24gUmQsIDM0IFJvYmluc29uIDc3LCDsi7HqsIDtj6zrpbQgMDY4ODk2!5e0!3m2!1sko!2skr!4v1557462815713!5m2!1sko!2skr" width="100%" height="455" frameborder="0" style="border:0" allowfullscreen></iframe></div>
						
					</div>
					<div class="line">
						<div class="box">
							<p>address</p>
							<span>77 Robinson Road, #34-01, Singapore 068896</span>
						</div>
						<div class="box">
							<p>tel</p>
							<span>+65 3129 0570</span>
						</div>
						<div class="box">
							<p>email</p>
							<span>info@pearsonsingapore.com</span>
						</div>
					</div>
				</div>
			</div> <!--    sub_box end   -->
		</div><!--   sub_content_box end   -->
		<div class="full_sub_content_box ty03">
			<div class="sub_content_box ty02 event">
				<div class="whywrap contact">
					<p class="title ty02">Please fill out the form below. We will get back to you as soon as we can.</p>
					<img src="<?=$cfg['baseUrl']?>/images/main/inquiry_img1.png" alt="">


					<div class="inquiry_container is_sub_page">

						<div class="inquiry_wrapper">
							<div class="inquiry_box">

								</div>
								<form method="post" action="<?=$cfg['href']?>/contactus/" id="contactForm">
									<input type="hidden" name="mode" value="inq" />
									<input type="hidden" name="cp_type" />
									<input type="hidden" name="contact_token" class="contactToken" value="" />
									<div class="in_box_01">
										<div class="box_form">
											<label for="name">Name</label>
											<input type="text" class="" name="cp_name" id="name"/>
											<label for="phone">Phone</label>
											<input type="text" class=""name="cp_phone" id="phone"/>
											<label for="mail">E-mail</label>
											<input type="text" class="" name="cp_email" id="mail"/>
										</div>
									</div>

									<div class="in_box_02">
										<div class="form_contents left">
											<div class="selectbox method_type">
												<div class="selectbox_label">TYPE</div>
												<? foreach($cfg['board']['category'][$boardName] as $key => $value){ ?>
													<span data-cp-cate="<?=$key?>"><?=$value?></span>
												<? } ?>
												<div class="selectbox_arrow"><i class="left"></i><i class="right"></i></div>
											</div>
										</div>
									</div>
									<div class="in_box_03">
										<label for="in_title">Title</label>
										<input type="text" class="" name="cp_title" id="in_title"/>
									</div>
									<div class="in_box_04">
										<label for="content">Message</label>
										<textarea name="cp_content" id="content" rows="5" placeholder=""></textarea>
									</div>
									<div class="in_btns" >
										<button type="reset" class="form_btn btn_cancel">Cancel</button>
										<button type="submit"id="nextStep" class="form_btn btn_orange">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--  sub_content_wrap end   -->
<? include_once __DIR__."/../footer.php"; ?>
