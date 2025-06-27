</div>
<footer>
	<? if(!$isMain){ ?>
		<div class="btn_canvas_wrap">
			<div class="btn_title" data-inquiry-open-btn="true"></div>
			<canvas id="btnCanvas"></canvas>
		</div>
	<? } ?>
<div class="downwrap">
	<p class="gray year">2020</p>
	<p class="guide"> <img src="<?=$cfg['baseUrl']?>/images/main/down_text.png" alt=""></p>
	<p class="gray ko">Get the latest information for your successful business in Singapore.</p>
<? if($isMain){?>
<a href="<?=$cfg['baseUrl']?>/images/common/Guide_to_Doing_Business_in_Singpaore_Pearson_&_Partners.pdf" download>download</a>
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
		<span>Stay ahead with our latest insights.</span>
		<form method="post" action="<?=$cfg['href']?>/subscribe/" id="subscribeForm">
			<fieldset>
				<legend></legend>
				<input type="hidden" id="subscribeToken" name="subscribe_token" value= "" />
				<input type="text" name="sc_mail" placeholder="EMAIL" id="subscribeEmail"/>
				<button type="submit">SIGN UP</button>
			</fieldset>
		</form>
		<div class="loca">
			<a href="<?=$cfg['href']?>/contactus/">
				<img src="<?=$cfg['baseUrl']?>/images/common/main_footer_map_en_repoint.png" alt="피어슨 앤 파트너스의 위치를 표시한 지도"/>
			</a>
			<span class="add">77 Robinson Road, #34-01, Singapore<br>
	TEL : +65 3129 0570<br>
	E-Mail : info@pearsonsingapore.com</span>
		</div>
		<p class="copy">COPYRIGHT 2020 Pearson & Partners.<br>
	ALL RIGHTS RESERVED.</p>
	</div>
	<div class="snswrap">
		<a href="https://medium.com/@pearsonpartners.global" target="_blank">미디움</a>
		<a href="https://www.linkedin.com/company/pearsonpartners" target="_blank">링크드인</a>
		<a href="https://www.facebook.com/pearsonandpartners" target="_blank">페이스북</a>
		<a href="https://www.instagram.com/pearson.partners/" target="_blank">인스타그램</a>
		<a href="http://twitter.com/partnerspearson" target="_blank">트위터</a>
		<a href="https://www.youtube.com/channel/UCKRDWA1zFMrUAVE83YDZylw?view_as=subscriber" target="_blank">유투브</a>
	</div>
</footer>
</div>
<script>
	grecaptcha.ready(function() {
		grecaptcha.execute('6Lfmq58UAAAAANNqsWxmMUt7_-YkUqNfGKGzZv6J', {action: '<?=$cfg['href']?>/subscribe/'}).then(function(token){
			$("#subscribeToken").val(token);
		});
		grecaptcha.execute('6Lfmq58UAAAAANNqsWxmMUt7_-YkUqNfGKGzZv6J', {action: '<?=$cfg['href']?>/contactus/'}).then(function(token){
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
