<div class="inquiry_container is_fixed_inquiry">
	<a class="btn close">
		<i></i>
	</a>
	<div class="inquiry_wrapper">
		<div class="inquiry_box">
			<h3>Thank you for your interest in Pearson.</h3>
			<div class="inquiry_img"></div>
			<form method="post" action="<?=$cfg['href']?>/contactus/" id="publicContactForm">
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
							<? foreach($cfg['board']['category']['inquiry'] as $key => $value){ ?>
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
					<button type="submit"id="nextStep" class="form_btn btn_orange">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>
</div>
