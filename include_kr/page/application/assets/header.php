<? include_once __DIR__."/../../../lib/common.php"; ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Online Form</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/css/style.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/css/theme/blue.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" />
	<!--<link href="<?=$cfg['href']?>/plugins/parsley/src/parsley.css" rel="stylesheet" />-->
	<link href="<?=$cfg['baseUrl']?>/page/application/assets/plugins/intl-tel-input/build/css/intlTelInput.css" rel="stylesheet" />
	
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=$cfg['baseUrl']?>/page/application/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="boxed-layout flat-black">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-without-sidebar">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-inverse">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header navbar-header-without-bg">
					<a href="index.html" class="navbar-brand"> Pearson & Partners</a>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="mailto:info@pearsonp.com" class="dropdown-toggle">
							<span class="hidden-xs">info@pearsonp.com</span>
						</a>
					</li>
					<li class="dropdown navbar-user">
						<a href="tel:02-6952-7579" class="dropdown-toggle">
							<span class="hidden-xs">+82 2 6952 7579</span>
						</a>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<!-- end #sidebar -->