</div>
<footer>
	<? if(!$isMain){ ?>
		<div class="btn_canvas_wrap">
			<div class="btn_title" data-inquiry-open-btn="true"></div>
			<canvas id="btnCanvas"></canvas>
		</div>
	<? } ?>
	
	<div class="downwrap">
		<p class="gray year"><?=date("Y")?></p>
		<p class="guide"> <img src="<?=$cfg['baseUrl']?>/images/main/down_text.png" alt=""></p>
		<p class="gray ko">글로벌 비즈니스의 시작, <br>싱가포르 법인설립 가이드</p>
		<? if($isMain){?>
		<a href="<?=$cfg['baseUrl']?>/images/common/guide_to_singapore.pdf" download>download</a>
		<?}else{?>
		<a href="<?=$cfg['href']?>/download/" >download</a>
		<?}?>
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

	<div class="inputwrap">
		<p>Subscribe to the newsletter</p>
		<span>피어슨파트너스에서 발행하는 싱가포르 최신 소식을 받아보세요</span>
		<form method="post" action="<?=$cfg['href']?>/subscribe/" id="subscribeForm">
			<fieldset>
				<legend></legend>
				<input type="text" name="sc_mail" placeholder="EMAIL" id="subscribeEmail"/>
				<input type="hidden" id="subscribeToken" name="subscribe_token" value= "" />
				<button type="submit">SIGN UP</button>
			</fieldset>
		</form>
		<div class="loca">
			<a href="<?=$cfg['href']?>/contactus/">
				<img src="<?=$cfg['baseUrl']?>/images/common/main_footer_map_mobile_250123.png" alt="피어슨 앤 파트너스의 위치를 표시한 지도"/>
			</a>
			<span class="add">서울특별시 강남구 압구정로 166<br>
			리저스빌딩<br>
			TEL : 02-6952-7579<!-- <br>
			E-MAIL : info@pearsonp.com--></span>
		</div>
		<p class="copy">COPYRIGHT <?=date("Y")?> Pearson & Partners.<br>
		ALL RIGHTS RESERVED.</p>
	</div>

	<div class="snswrap">
		<a href="https://blog.naver.com/pearsonp" target="_blank">네이버</a>
		<a href="https://brunch.co.kr/@globalbusiness" target="_blank">브런치</a>
		<a href="https://www.linkedin.com/company/pearsonpartners" target="_blank">링크드인</a>
		<a href="https://www.facebook.com/partnerspearson/" target="_blank">페이스북</a>
		<a href="https://www.instagram.com/pearson.partners/" target="_blank">인스타</a>

		<a href="https://twitter.com/_pearson_global" target="_blank">트위터</a>
		<a href="https://www.youtube.com/channel/UCKRDWA1zFMrUAVE83YDZylw?view_as=subscriber" target="_blank">유투브</a>
	</div>
</footer>
</div>

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
			alert("성을 입력해주세요.");
			return false;
		}
		if (!lastName) {
			alert("이름을 입력해주세요.");
			return false;
		}
		if (!companyName) {
			alert("회사명을 입력해주세요.");
			return false;
		}
		if (!email) {
			alert("이메일을 입력해주세요.");
			return false;
		}

		if (!emailCheck(email)) {
			alert("이메일 형식이 올바르지 않습니다.");
			return false;
		}

		$.ajax({
			url: '/mobile/include_kr/ajax_process/ajax.php', // 서버의 폼 처리 URL
			method: 'POST',
			data: frm.serialize(), // 폼 데이터를 직렬화하여 전송
			dataType: 'json',
			success: function(response) {
				//console.log(response);
				<?php if($isMain){ ?>
				// 동적으로 a 태그 생성 및 다운로드
				const a = document.createElement('a');
				a.href = "<?=$cfg['baseUrl']?>/images/common/guide_to_singapore.pdf";
				a.download = "guide_to_singapore.pdf"; // 다운로드 파일 이름 설정
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
		grecaptcha.execute('6LedXKMUAAAAAAcvBSN3MCrGBoZ6d9VSNZXfP9Eh', {action: '<?=$cfg['href']?>/subscribe/'}).then(function(token){
			$("#subscribeToken").val(token);
		});
		grecaptcha.execute('6LedXKMUAAAAAAcvBSN3MCrGBoZ6d9VSNZXfP9Eh', {action: '<?=$cfg['href']?>/contactus/'}).then(function(token){
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
