<? include_once __DIR__."/lib/common.php";?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, user-scalable=no, target-densitydpi=medium-dpi">
	<meta property="og:url" content="https://<?=$_SERVER['SERVER_NAME']?><?=$_SERVER['REDIRECT_URL']?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Pearson & Partners">
	<meta property="og:title" content="<?=(($meta_title != "") ? $meta_title : $cfg['meta']['en']['title'])?>" />
	<meta property="og:description" content="<?=(($meta_description != "") ? $meta_description : $cfg['meta']['en']['description'])?>" />
	<meta property="og:image" content="https://<?=$_SERVER['SERVER_NAME']?>/include_sg/images/sns_logo.png" />
	<meta name="title" content="<?=(($meta_title != "") ? $meta_title : $cfg['meta']['en']['title'])?>">
	<meta name="publisher" content="Pearson & Partners">
	<meta name="author" content="Pearson & Partners">
	<meta name="keywords" content="<?=(($meta_keyword != "") ? $meta_keyword : $cfg['meta']['en']['keyword'])?>">
	<meta name="description" content="<?=(($meta_description != "") ? $meta_description : $cfg['meta']['en']['description'])?>">
	<meta name="twitter:card" content="https://<?=$_SERVER['SERVER_NAME']?>/include_sg/images/sns_logo.png">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="msvalidate.01" content="C1E9B7475F9F130DB60350AECDFB67A8" />
	<meta http-equiv="x-rim-auto-match" content="none" />
	<link rel="shortcut icon" href="<?=$cfg['baseUrl']?>/images/favicon.png">
	<link rel="alternate" href="https://<?=$_SERVER['SERVER_NAME']?>/" hreflang="x-default">
	<link rel="canonical" href="<?=$cfg['meta']['canonical']?>" />
	<link rel="stylesheet" type="text/css" href="<?=setBrowserCache("/css/common.css")?>" />
	<? if($isMain){?>
	<link rel="stylesheet" type="text/css" href="<?=setBrowserCache("/css/main.css")?>" />
	<? } else { ?>
	<link rel="stylesheet" type="text/css" href="<?=setBrowserCache("/css/sub.css")?>" />
	<? } ?>
	<script type="text/javascript" src="<?=$cfg['baseUrl']?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?=$cfg['baseUrl']?>/js/jquery-ui-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?=setBrowserCache("/js/common.js")?>"></script>
	<? if($isMain){ ?>
	<script type="text/javascript" src="<?=setBrowserCache("/js/main.js")?>"></script>
	<? } else { ?>
	<script type="text/javascript" src="<?=setBrowserCache("/js/sub.js")?>"></script>
	<? } ?>
	<title><?=(($meta_title != "") ? $meta_title : $cfg['meta']['en']['title'])?></title>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '2249279522063607');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=2249279522063607&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140301142-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-140301142-1');
	</script>
	<script src="https://www.google.com/recaptcha/api.js?render=6Lfmq58UAAAAANNqsWxmMUt7_-YkUqNfGKGzZv6J"></script>
	<?
		if($cfg['meta_url'][2] == "faqs"){
			include_once __DIR__."/schema.org.faq.php";
		} else {
			include_once __DIR__."/schema.org.default.php";
		}
	?>
</head>
<body oncontextmenu="return false">
	<header>
		<div class="headerwrap">
			<div class="gnbwrap">
				<div class="depth1">
					<div class="logo">
						<a href="<?=$cfg['href']?>/"><img src="<?=$cfg['baseUrl']?>/images/main/logo.png" alt="logo"/></a>
					</div>
					<nav>
						<ul class="">
							<li class="<?=isActive("aboutus")?>">
								<a href="<?=$cfg['href']?>/aboutus/ourmission/" title="About Us">about us</a>
							</li>
							<li class="<?=isActive("ourservice")?>">
								<a href="<?=$cfg['href']?>/ourservice/why" title="Our Services">our services</a>
							</li>
							<li class="<?=isActive("insights")?>">
								<a href="<?=$cfg['href']?>/insights/" title="Insights">insights</a>
							</li>
							<li class="<?=isActive("download")?>">
								<a href="<?=$cfg['href']?>/download/" title="Download">download</a>
							</li>
							<!--
							<li class="<?=isActive("testimonials")?>">
								<a href="<?=$cfg['href']?>/testimonials/" title="Testimonials">Testimonials</a>
							</li>
							-->
							<li class="<?=isActive("contactus")?>">
								<a href="<?=$cfg['href']?>/contactus/" title="Contact Us">contact us</a>
							</li>
						</ul>
					</nav>
				</div><!-- depth1 end-->
				<div class="lang_wrap">
					<a href="#" title="English"><i class="lang_ico en active"></i></a><a href="<?=$cfg['href_ko']?>" title="Korean"><i class="lang_ico ko"></i></a>
				</div>
				<div class="subwrap">
					<div class="ulwrap">
						<div class="allwrap">
							<ul class="depth2 menu1">
								<li class="<?=isActive("aboutus/ourmission")?>"><a href="<?=$cfg['href']?>/aboutus/ourmission/">Our Mission</a></li>
								<li class="<?=isActive("aboutus/whatwedo")?>"><a href="<?=$cfg['href']?>/aboutus/whatwedo/">What We Do</a></li>
							</ul>
							<div class="menu_left menu_img1">
								<div class="menu_bg"></div>
								<ul class="">
									<li>
										<span class="eng">Expanding one’s business abroad is itself an act of pioneering. We believe valuable things in this world can only be created by the act of pioneering.</span>
									</li>
									<li>
									“To make a world without barriers for business expansion.”
									</li>
									<li>
										We help you build your successful business in Singapore.
									</li>
								</ul>

							</div>
						</div>
						<div class="allwrap">
							<ul class="depth2 menu2">
									<li class="<?=isActive("ourservice/why")?>"><a href="<?=$cfg['href']?>/ourservice/why">Why Singapore?</a></li>
									<li class="<?=isActive("ourservice/incorporation")?>"><a href="<?=$cfg['href']?>/ourservice/incorporation">Incorporation</a></li>
									<li class="<?=isActive("ourservice/bank")?>"><a href="<?=$cfg['href']?>/ourservice/bank">Bank Account</a></li>
									<li class="<?=isActive("ourservice/taxation")?>"><a href="<?=$cfg['href']?>/ourservice/taxation">Taxation</a></li>
									<li class="<?=isActive("ourservice/accounting")?>"><a href="<?=$cfg['href']?>/ourservice/accounting">Accounting</a></li>
									<li class="<?=isActive("ourservice/visa")?>"><a href="<?=$cfg['href']?>/ourservice/visa">Visa</a></li>
									<li class="<?=isActive("ourservice/faqs")?>"><a href="<?=$cfg['href']?>/ourservice/faqs">FAQs</a></li>
							</ul>
							<div class="menu_left menu_img2">
								<div class="menu_bg"></div>
								<ul class="">
									<li>From setting up a corporate entity to living in Singapore, we provide a total solution to doing business in Singapore.</li>
									<li>Strategic location and an open economy make Singapore the choicest business destination to set up an international enterprise.</li>
									<li>Doing business in Singapore starts with establishing a local corporate entity.</li>
									<li>A corporate bank account is among the key basics of incorporating a company in Singapore. Singapore houses 127 commercial banks, out of which 5 are local and 122 are foreign banks.</li>
									<li>Singapore has an attractive taxation policy – its corporate and personal tax rates, tax mitigation proceedings, zero tax on capital gains, single-tier tax system, and far-reaching dual tax contracts.</li>
									<li>It would be brilliant to hire an accounting specialist to help with your accounting, payroll and GST registration services.</li>
									<li>All immigrants with the intention of working in Singapore or starting a business there, must have a valid pass.</li>
									<li>Here are the most asked questions about doing business in Singapore.</li>
									<li>
										“To make a world without barriers for business expansion.”
									</li>
								</ul>
							</div>
						</div>
						<div class="allwrap">
							<ul class="depth2 menu3">
								<? foreach($cfg['board']['category']['insights_en'] as $key => $value){ ?>
									<?
										$category_tmp = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $value);
										$category_tmp = preg_replace('/\s{2,}/', ' ', $category_tmp);
										$category_tmp = preg_replace('/ /', '-', $category_tmp);
									?>
									<li class="<?=isActiveCustom("insights", "c", $key)?>"><a href="<?=$cfg['href']?>/insights/category/<?=$category_tmp?>/"><?=$value?></a></li>
								<? } ?>
									<li><a href="https://sg.jooble.org/jobs-business-advisor" target="_blank">Business Advisor Jobs</a></li>
							</ul>
							<div class="menu_left menu_img3">
								<div class="menu_bg"></div>
								<ul class="">
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
									<li>Feed yourself with more in-depth insights on doing business in Singapore.</li>
								</ul>
							</div>
						</div>
						<div class="allwrap">
							<ul class="depth2 menu4">
								<li  class="<?=isActive("download")?>"><a href="<?=$cfg['href']?>/download">Download</a></li>
							</ul>
							<div class="menu_left menu_img4">
								<div class="menu_bg"></div>
								<ul class="">
									<li>
										You can download required documents for registrations and government-provided information in this section.
									</li>
									<li>
										You can download required documents for registrations and government-provided information in this section.
									</li>
								</ul>

							</div>
						</div>
						<!--
						<div class="allwrap">
							<ul class="depth2 menu5">
								<li class="<?=isActive("testimonials")?>"><a href="<?=$cfg['href']?>/testimonials">Testimonials</a></li>
							</ul>
							<div class="menu_left menu_img5">
								<div class="menu_bg"></div>
								<ul class="">
									<li>What our clients say about us.</li>
									<li>What our clients say about us.</li>
								</ul>
							</div>
						</div>
						-->
						<div class="allwrap">
							<ul class="depth2 menu5">
								<li class="<?=isActive("contactus")?>"><a href="<?=$cfg['href']?>/contactus">Contact Us</a></li>
							</ul>
							<div class="menu_left menu_img5">
								<div class="menu_bg"></div>
								<ul class="">
									<li>
									For more inquiries or service request, contact us directly.
									</li>
									<li>
									For more inquiries or service request, contact us directly.
									</li>
								</ul>
							</div>
						</div>
					</div><!--  ulwrap end  -->
				</div><!--  subwrap end  -->
			</div><!--  gnbwrap end  -->
		</div>	<!--  headerwrap end  -->
	</header>

<? if(!$isMain){?>
	<div class="visual <?=explode("/", $cfg['page_code'])[0]?>">
		<div class="visual_inner"></div>
		<div class="dot_bg"></div>
		<div class="text_wrap fwrap">
			<h1>
				<i>W</i><i>e&nbsp;</i><i>b</i><i>r</i><i>i</i><i>n</i><i>g</i><i>&nbsp;</i><i>t</i><i>h</i><i>e</i><i>&nbsp;</i><i>W</i><i>o</i><i>r</i><i>l</i><i>d</i><i></i><i> t</i><i>o</i><i> S</i><i>i</i><i>n</i><i>g</i><i>a</i><i>p</i><i>o</i><i>r</i><i>e</i><i>,</i>
				<i> </i><i>a</i><i>n</i><i>d</i><i> t</i><i>a</i><i>k</i><i>e</i><i>&nbsp;</i><i>S</i><i>i</i><i>n</i><i>g</i><i>a</i><i>p</i><i>o</i><i>r</i><i>e</i><i>&nbsp;</i><i>t</i><i>o</i><i>&nbsp;</i><i>t</i><i>h</i><i>e</i><i>&nbsp;</i><i>W</i><i>o</i><i>r</i><i>l</i><i>d</i>.</i>
			</h1>
		</div>
	</div>
<?}?>
