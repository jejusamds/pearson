		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade in" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?=setBrowserCache("/admin/assets/js/setTextByte.js")?>"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=$cfg['dir']['admin']?>/assets/js/apps.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>