<!doctype html>
<!--[if IE 8]> <html lang="ko" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ko">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$cfg['siteName']?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<link rel="shortcut icon" href="<?=$cfg['baseUrl']?>/images/favicon.png" type="image/x-icon" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?=setBrowserCache("/admin/assets/css/style.css")?>" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" />
	<link href="<?=$cfg['dir']['admin']?>/assets/css/theme/default.css" rel="stylesheet" id="theme" />


	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/pace/pace.min.js"></script>
	<script src="<?=$cfg['dir']['admin']?>/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="<?=$cfg['dir']['admin']?>/assets/js/common.js"></script>
</head>
<? if(strpos($_SERVER['PHP_SELF'], "login_view") !== false){ ?>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
<? } else { ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
<? } ?>