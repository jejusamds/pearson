<script>
	$(function(){
		$("#txt_username").focus();
	});
</script>
<!-- begin login -->
<div class="login bg-black animated fadeInDown">
	<!-- begin brand -->
	<div class="login-header">
		<div class="brand">
			<?=$cfg['siteName']?>
			<small>Site Administrator Mode</small>
		</div>
		<div class="icon"><i class="fa fa-sign-in"></i></div>
	</div>
	<!-- end brand -->
	<div class="login-content">
		<form action="index.php" method="POST" class="margin-bottom-0">
			<div class="form-group m-b-20">
				<input type="text" class="form-control input-lg inverse-mode no-border" id="txt_username" name="username" placeholder="id" required />
			</div>
			<div class="form-group m-b-20">
				<input type="password" class="form-control input-lg inverse-mode no-border" id="txt_password" name="password" placeholder="Password" required />
			</div>
			<div class="login-buttons">
				<button type="submit" class="btn btn-success btn-block btn-lg" id="btn_login">LOGIN</button>
			</div>
		</form>
	</div>
</div>
<!-- end login -->