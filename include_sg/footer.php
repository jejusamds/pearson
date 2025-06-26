<? if(!$isMain){ ?>
	<div class="btn_canvas_wrap">
		<div class="btn_title" data-inquiry-open-btn="true"></div>
		<canvas id="btnCanvas"></canvas>
	</div>
<? } ?>
<footer>
	<div class="footer_wrap">
		<div class="footer_top">

			<div class="footer_inner">
				<span class="guide_year"><?=date("Y")?></span>
				<img src="<?=$cfg['baseUrl']?>/images/main/main_footer_img_01.png" alt="Guide to Singapore"/>
				<span class="guide_txt">Get the latest information for your successful business in Korea.</span>
				<? if($isMain){?>
				<a href="<?=$cfg['baseUrl']?>/images/common/guide_to_korea.pdf" download class="down_btn">download</a>
				<?}else{?>
				<a href="<?=$cfg['href']?>/download/" class="down_btn">download</a>
				<?}?>
			</div>

		</div>
	</div>

	<? if($isMain){ ?>
	<div class="client_container">
		<h2>OUR PARTNERS</h2>
		<ul class="client_inner">
			<? foreach($cfg['main']['our_partners'] as $key => $value){ ?>
			<li class="client_item"><img src="<?=$cfg['baseUrl']?>/images/main/<?=$value['img']?>" alt="<?=$value['title']?>" /></li>
			<? } ?>
		</ul>
	</div>
	<? } ?>

	<div class="footer_wrap bottom">
		<div class="footer_bottom">
			<div class="footer_box1">
				<img src="<?=$cfg['baseUrl']?>/images/main/main_footer_img_11.png" alt="Pearson & Partners Footer Logo"/>
				<span class="copy">
					COPYRIGHT <?=date("Y")?> PEARSON & PARTNERS. <br/>
					ALL RIGHTS RESERVED.
				</span>
				<!-- <span class="by">
					<a href="http://www.handsomefish.co.kr" target="_blank">DESIGNED BY HANDSOMEFISH</a>
				</span> -->
			</div>
			<div class="footer_box2">
				<a href="<?=$cfg['href']?>/contactus/">
					<img src="<?=$cfg['baseUrl']?>/images/main/main_footer_map_sg_250123.png" alt="Pearson & Partners Location"/>
				</a>
				<span class="add">Address : 166, Apgujeong-ro, Gangnam-gu, Seoul,
					 <br/>
						  <span>Republic of Korea (06030)</span></span>
				<span class="add">TEL : +82-2-6956-7872<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<!-- <span class="add">E-Mail : info@pearsonkorea.com</span> -->
			</div>

			<div class="footer_box3">
				<span class="footer_box_tit">country</span>
				<ul class="coutry">
					<li>
						<a href="<?=$cfg['href_en']?>/">
							singapore
						</a>
					</li>
					<li class="active">
						<a href="javascript:void(0);">
							korea
						</a>
					</li>
				</ul>
				<ul class="sns">
					<li>
						<a href="https://medium.com/@pearsonpartners.global" target="_blank">
							<span>Medium로 이동</span>
						</a>
					</li>
					<li>
						<a href="https://www.linkedin.com/company/pearsonpartners" target="_blank">
							<span>linkdin으로 이동</span>
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/pearsonandpartners" target="_blank">
							<span>페이스북으로 이동</span>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/pearson.partners/" target="_blank">
							<span>인스타그램으로 이동</span>
						</a>
					</li>
					<li>
						<a href="http://twitter.com/partnerspearson" target="_blank">
							<span>트위터로 이동</span>
						</a>
					</li>
					<li>
						<a href="https://www.youtube.com/channel/UCKRDWA1zFMrUAVE83YDZylw?view_as=subscriber" target="_blank">
							<span>유튜브로 이동</span>
						</a>
					</li>
				</ul>
			</div>

			<div class="footer_box4">
				<span class="footer_box_tit">subscribe to the newsletter</span>
				<span class="mail">
					Stay ahead with our latest insights.
				</span>
				<form method="post" action="<?=$cfg['href']?>/subscribe/" id="subscribeForm">
					<fieldset>
						<legend></legend>
						<input type="text" name="sc_mail" placeholder="EMAIL" id="subscribeEmail"/>
						<input type="hidden" id="subscribeToken" name="subscribe_token" value= "" />
						<button type="submit">SIGN UP</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript" language="javascript">

	function emailCheck(email_address){     
		email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		if(!email_regex.test(email_address)){ 
			return false; 
		}else{
			return true;
		}
	}		

	function go_download() {
		// #download_frm 의 인풋 입력 체크후 ajax 로 폼전송하고 완료되면 기존 다운로드 링크로 이동
		var frm = $("#download_frm");
		var firstName = frm.find("input[name='download_frm_first_name']").val();
		var lastName = frm.find("input[name='download_frm_last_name']").val();
		var companyName = frm.find("input[name='download_frm_company_name']").val();
		var email = frm.find("input[name='download_frm_email']").val();

		if (!firstName) {
			alert("Please enter your first name.");
			frm.find("input[name='download_frm_first_name']").focus();
			return false;
		}
		if (!lastName) {
			alert("Please enter your last name.");
			frm.find("input[name='download_frm_last_name']").focus();
			return false;
		}
		if (!companyName) {
			alert("Please enter your company name.");
			frm.find("input[name='download_frm_company_name']").focus();
			return false;
		}
		if (!email) {
			alert("Please enter your email.");
			frm.find("input[name='download_frm_email']").focus();
			return false;
		}

		if (!emailCheck(email)) {
			alert("The email format is invalid.");
			frm.find("input[name='download_frm_email']").focus();
			return false;
		}


		$.ajax({
			url: '/include_sg/ajax_process/ajax.php', // 서버의 폼 처리 URL
			method: 'POST',
			data: frm.serialize(), // 폼 데이터를 직렬화하여 전송
			dataType: 'json',
			success: function(response) {
				// Event snippet for main download button conversion page In your html page, 
				// add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button.
				gtag('event', 'conversion', { 'send_to': 'AW-318858636/F1Y-CI2tpbsaEIzLhZgB' }); 
				
				console.log(response);
				<?php if($isMain){ ?>
				// 동적으로 a 태그 생성 및 다운로드
				const a = document.createElement('a');
				a.href = "<?=$cfg['baseUrl']?>/images/common/guide_to_korea.pdf";
				a.download = "guide_to_korea.pdf"; // 다운로드 파일 이름 설정
				document.body.appendChild(a);
				a.click();
				document.body.removeChild(a);
				<?php }else{ ?>
				const a = document.createElement('a');
				a.href = "<?=$cfg['href']?>/download/";
				a.target = "_blank"; // 새 창 열기
				document.body.appendChild(a);
				a.click();
				document.body.removeChild(a);
				<?php } ?>
				download_popup();
			},
			error: function(error) {
				console.log(error);
			}
		});
	}

	// 팝업 스크립트
	function download_popup() {
		if( $(".popup_con").css("display") == "none" ){
			$(".popup_con_bg").fadeIn();
			$(".popup_con").fadeIn();
		}else{
			$(".popup_con_bg").fadeOut();
			$(".popup_con").fadeOut();
		}
	}
</script>

<script>
	grecaptcha.ready(function() {
		grecaptcha.execute('6LekXKMUAAAAAM4lNwcQQSiSdzcRHt6QKP9k4Kyv', {action: '<?=$cfg['href']?>/subscribe/'}).then(function(token){
			$("#subscribeToken").val(token);
		});
		grecaptcha.execute('6LekXKMUAAAAAM4lNwcQQSiSdzcRHt6QKP9k4Kyv', {action: '<?=$cfg['href']?>/contactus/'}).then(function(token){
			$(".contactToken").val(token);
		});
	});
</script>

<style>
.grecaptcha-badge { display: none; }
</style>

<? include_once __DIR__."/page/contactus.form.php"; ?>

<!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7904967.js"></script>
<!-- End of HubSpot Embed Code -->
</body>
</html>
