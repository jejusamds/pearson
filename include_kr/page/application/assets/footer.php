		<!-- begin #footer -->
		<div id="footer" class="footer">
		    COPYRIGHT <?=date("Y")?> PEARSON & PARTNERS. ALL RIGHTS RESERVED.
		</div>
		<!-- end #footer -->

        <!-- begin theme-panel -->
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-ui/ui/minified/jquery.ui.touch-punch.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?=$cfg['baseUrl']?>/page/application/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?=$cfg['baseUrl']?>/page/application/assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?=$cfg['baseUrl']?>/page/application/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!--
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/parsley/dist/parsley.js"></script>
	-->

	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/intl-tel-input/build/js/intlTelInput-jquery.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/js/apps.js"></script>
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/js/form.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
<style>
.ui-sortable-assoc {
    list-style: none;
    padding-left: 0;
}

/* 법인명 상시 대문자 */
.form-control.text-uppercase {
	text-transform: uppercase;
}

/* 현지대리이사 필요 툴팁 */
.capital-amount-tooltip .tooltip-inner,
.acting-local-tooltip .tooltip-inner {
	word-break: keep-all;
	color: #555;
	background-color: #e2e7eb;
}
.acting-local-tooltip  .tooltip-inner {
	max-width: 100%;
}
.capital-amount-tooltip .tooltip-inner {
	max-width: 380px;
}

.acting-local-tooltip .tooltip.bottom,
.capital-amount-tooltip .tooltip.bottom {
	position: relative;
	top: 0 !important;
    left: 0 !important;
    padding-bottom: 0 !important;
}

.acting-local-tooltip .tooltip.bottom .tooltip-arrow {
	display: none;
}
.capital-amount-tooltip .tooltip.bottom .tooltip-arrow {
	border-bottom-color: #e2e7eb;
}
.acting-local-tooltip .tooltip.right .tooltip-arrow {
	border-right-color: #e2e7eb;
}
.acting-local-tooltip .tooltip.right {
	margin-left: 8px;
}
</style>
</body>
</html>