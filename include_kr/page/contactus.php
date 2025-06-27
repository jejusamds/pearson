<?

    // 메인으로 리다이렉트
    //header("Location: /");

	$cfg['page_code'] = "contactus";
	include_once __DIR__."/../lib/common.php";

	$boardName = "inquiry";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/contactus/";

	if($_POST['mode'] == "inq"){
		$data = array(
			'secret' => "6LedXKMUAAAAALgOFkWK2i0BLkF9M1QXOSnZlFMa",
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
				$alreadySubscribe = Queryi("SELECT email FROM ".$cfg['db']['prefix']."board_subscribe WHERE isDelete = 'N' AND email = ?", array(encodeData($_POST['cp_email'])), true);

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

					Queryi("INSERT INTO ".$cfg['db']['prefix']."board_subscribe SET $ssDataSet", $ssParams);
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

			if($res['isInsert']){
				include_once __DIR__."/../lib/PHPMailer/PHPMailerAutoload.php";

				$email_subject = "[피어슨파트너스] 싱가포르 문의 ".(($_POST['cp_name'] != "" || $_POST['cp_phone'] != "") ? '(' : '').$_POST['cp_name'].(($_POST['cp_name'] != "") ? ", ".$_POST['cp_phone'] : $_POST['cp_phone']).(($_POST['cp_name'] != "" || $_POST['cp_phone'] != "") ? ')' : '');
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

				alert('문의가 완료되었습니다.\n빠른 시일내로 답변 드리겠습니다.\n감사합니다.', $_SERVER['HTTP_REFERER']);
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
			<p class="sub_title ty02 ">contact us</p>

			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
			<script>
			hbspt.forms.create({
				portalId: "7904967",
				formId: "e7c89021-990f-4939-9953-7f04fb820018"
			});
			</script>

			<div class="whywrap contact event contact_us">
				<div class="title">
					<ul class="contact_tab">
						<li class="active"><a href="#" data-tab-id=".map_ko">Korea Office</a></li>
						<li class=""><a href="#" data-tab-id=".map_sg">Singapore Office</a></li>
					</ul>
				</div>
				<div class="map_wrap_container map_ko">
					<div class="map_wrap">
						<div class="map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.2077851916365!2d127.02525547666747!3d37.52659892641588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca391bf0f81c5%3A0x249647f2146bfe8c!2z7ISc7Jq47Yq567OE7IucIOqwleuCqOq1rCDslZXqtazsoJXroZwgMTY2!5e0!3m2!1sko!2skr!4v1737617813595!5m2!1sko!2skr" width="100%" height="455" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
					<div class="line">
						<div class="box">
							<p>address</p>
							<span>서울특별시 강남구 압구정로 166 리저스빌딩</span>
						</div>
						<div class="box">
							<p>tel</p>
							<span>02.6952.7579</span>
						</div>
						<!-- <div class="box">
							<p>email</p>
							<span>info@pearsonp.com</span>
						</div> -->
					</div>
				</div>
				<div class="map_wrap_container map_sg" style="display: none;">
					<div class="map_wrap">
						<div class="map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8266629758114!2d103.84601815695258!3d1.277470521101321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19124fd98a39%3A0xdd953120157feb0c!2zNzcgUm9iaW5zb24gUmQsIExldmVsIDM0LCA3NyBSb2JpbnNvbiA3Nywg7Iux6rCA7Y-s66W0IDA2ODg5Ng!5e0!3m2!1sko!2skr!4v1553492382638" width="100%" height="455" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="line">
						<div class="box">
							<p>address</p>
							<span>77 Robinson Road, Level 34,<br />77 Robinson Road Singapore 068896</span>
						</div>
						<div class="box">
							<p>tel</p>
							<span>+65 6809 2116</span>
						</div>
						<!-- <div class="box">
							<p>email</p>
							<span>info@pearsonp.com</span>
						</div> -->
					</div>
				</div>
			</div>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
</div><!--  sub_content_wrap end   -->
<script>
$(function(){
	$(".contact_tab a").bind("click", function(e){
		e.preventDefault();
		
		var $this = $(this), $target = $this.data("tabId");

		$this.closest(".contact_tab").find("a").not($this).parent().removeClass("active");
		$this.parent().addClass("active");

		$(".map_wrap_container").not($target).hide();
		$(".map_wrap_container" + $target).show();
	});
});
</script>
<? include_once __DIR__."/../footer.php"; ?>
