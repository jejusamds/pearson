<?
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE);

	$cfg['db'] = array(
		"host" => "121.254.168.67",
		"-u" => "pearsonpartners",
		"-p" => "password12#",
		"name" => "dbpearsonpartners",
		"prefix" => "pap_"
	);

	$cfg['baseUrl'] = "/include";
	$cfg['access_ip'] = array("192.168.0.6");
	$cfg['access_ip_usable'] = false;

	$cfg['root'] = $_SERVER['DOCUMENT_ROOT'];
	$cfg['siteName'] = "PEARSON & PARTNERS";

	$cfg['dir'] = array(
		"admin" => $cfg['baseUrl']."/admin",
		"board" => $cfg['baseUrl']."/data/board",
		"editor" => $cfg['baseUrl']."/data/editor",
		"online_application" => $cfg['baseUrl']."/data/online_application",
	);
	
	$cfg['boardDirectory'] = $cfg['baseUrl']."/admin/views/board/upload";
	$cfg['etcDirectory'] = $cfg['baseUrl']."/admin/views/etc/upload";
	$cfg['domains'] = array("pearsonkorea.com", "pearsonp.com", "pearsonpartners.gabia.io");

	$cfg['forced_crypto_secret_key'] = "OXXAeBmecnnq3fHBXZOqc7XSzGieF9ApyrJOWTdv";
	$cfg['forced_crypto_iv'] = "dw21fweskihrizfd";

	$cfg['public_key'] = "@UTK2NTT8Keut";

	$cfg['session_names'] = array(
		'id' => '',
		'level' => '',
		'name' => ''
	);

	$locator['info'] = array(array("title" => "PEARSON & PARTNERS", "link" => "/"));

	/*
		; board cfg
	*/
	$cfg['board'] = array(
		"password_check_board" => array("insights", "insights_en", "insights_sg", "insights_uk_kr"),
		"type_sg_kr" => array(
			"faq" => "FAQ",
			"insights" => "Insights",
			"download" => "download",
			"inquiry" => "문의하기",
			"subscribe" => "Subscribe to the newsletter",
			"download_log" => "다운로드 로그(국문)",
		),
		"type_sg_en" => array(
			"faq_en" => "FAQ",
			"insights_en" => "Insights",
			"download_en" => "download",
			"testimonials_en" => "Testimonials",
			"inquiry_en" => "문의하기",
			"subscribe_en" => "Subscribe to the newsletter"
		),
		"type_kr_en" => array(
			"faq_sg" => "FAQ",
			"insights_sg" => "Insights",
			"download_sg" => "download",
			"inquiry_sg" => "문의하기",
			"subscribe_sg" => "Subscribe to the newsletter",			
			"download_log_en" => "다운로드 로그(영문)",
		),
		"type_uk_kr" => array(
			"faq_uk_kr" => "FAQ",
			"insights_uk_kr" => "Insights",
			"download_uk_kr" => "download",
			"inquiry_uk_kr" => "문의하기",
			"subscribe_uk_kr" => "Subscribe to the newsletter"
		),
		"no_image" => array(
			"insights", "download", "insights_sg", "download_sg", "download_uk_kr", "insights_uk_kr"
		),
		"category" => array(
			"faq" => array(
				"corporate" => "법인설립",
				"bank" => "은행계좌",
				"tax" => "세무회계",
				"visa" => "사업비자"
			),
			"faq_sg" => array(
				"overview" => "overview",
				"Incorporation" => "Incorporation",
				"visa" => "visa",
				"tax" => "Taxation & Accounting",
				"recruitment" => "recruitment",
				"partner" => "finding partner",
				"livinginkorea" => "living in korea"
			),
			"faq_en" => array(
				"incorporation" => "Incorporation",
				"tax" => "Taxation",
				"bank" => "Bank Account",
				"acc" => "Accounting",
				"visa" => "Business Visa",
			),
			"faq_uk_kr" => array(
				"corporate" => "법인설립",
				"bank" => "은행계좌",
				"tax" => "세무회계"
			),
			"insights" => array(
				"corp" => "법인설립",
				"visa" => "비자",
				"tax" => "세무회계",
				"inv" => "투자",
				"sgp" => "싱가포르 라이프",
				"etc" => "기타"
			),
			"insights_sg" => array(
				"business" => "Business in Korea",
				"corp" => "Incorporation",
				"visa" => "Visa",
				"tax" => "Taxation & Accounting",
				"rec" => "Recruitment",
				"living" => "Living in Korea"
			),
			"insights_uk_kr" => array(
				"corp" => "법인설립",
				"visa" => "비자",
				"tax" => "세무회계",
				"inv" => "투자",
				"sgp" => "영국 라이프",
				"etc" => "기타"
			),
			"inquiry" => array(
				"corp" => "법인설립",
				"visa" => "비자 현지정착",
				"money" => "자금운영",
				"keep" => "법인유지",
				"etc" => "기타"
			),
			"inquiry_uk_kr" => array(
				"corp" => "법인설립",
				"visa" => "비자 현지정착",
				"money" => "자금운영",
				"keep" => "법인유지",
				"etc" => "기타"
			),
			"inquiry_sg" => array(
				"corp" => "Incorporation",
				"visa" => "Visa",
				"tax" => "Taxation & Accounting",
				"recruit" => "Recruitment",
				"partner" => "Finding Partners",
				"living" => "Living in Korea",
				"etc" => "Others"
			),
			"insights_en" => array(
				"busy" => "Business in Singapore",
				"corp" => "Incorporation",
				"bank" => "Bank Account",
				"tax" => "Tax",
				"acc" => "Accounting",
				"visa" => "Visa",
				"inve" => "Investment",
				"live" => "Living in Singapore",
			),
			"inquiry_en" => array(
				"corp" => "Incorporation",
				"bank" => "Bank Account",
				"tax" => "Tax",
				"partner" => "Accounting",
				"visa" => "Visa",
				"etc" => "Others"
			),
		),
		"skin" => array(
			"list" => array(
				"faq" => "faq",
				"faq_en" => "faq",
				"faq_sg" => "faq",
				"faq_uk_kr" => "faq",
				"insights" => "insights",
				"insights_en" => "insights",
				"insights_sg" => "insights",
				"insights_uk_kr" => "insights",
				"download" => "download",
				"download_en" => "download",
				"download_sg" => "download",
				"download_uk_kr" => "download",
			),
			"view" => array(
				"insights" => "insights",
				"insights_en" => "insights",
				"insights_sg" => "insights",
				"insights_uk_kr" => "insights",
			)
		),
		"thumbnail" =>  array(
			"sample" => array(array("width" => 150, "height" => 150))
		),
		"adminPaging" => array(
			"default" => array(
				"itemMax" => 10,
				"blockMax" => 10
			),
			"subscribe" => array(
				"itemMax" => 100,
				"blockMax" => 5
			),
			"subscribe_sg" => array(
				"itemMax" => 100,
				"blockMax" => 5
			)
		),
		"paging" => array(
			"default" => array(
				"itemMax" => 10,
				"blockMax" => 10
			),
			"faq" => array(
				"itemMax" => 100,
				"blockMax" => 5
			),
			"faq_en" => array(
				"itemMax" => 100,
				"blockMax" => 5
			),
			"faq_sg" => array(
				"itemMax" => 100,
				"blockMax" => 5
			),
			"download" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
			"download_en" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
			"download_sg" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
			"insights" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
			"insights_sg" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
			"insights_en" => array(
				"itemMax" => 4,
				"blockMax" => 5
			),
		),
		"qstr" => array(
			"faq" => array("board", "search"),
			"insights" => array("board", "search"),
			"download" => array("board", "search"),
			"inquiry" => array("board", "search"),
			"subscribe" => array("board", "search"),
			"faq_sg" => array("board", "search"),
			"insights_sg" => array("board", "search"),
			"download_sg" => array("board", "search"),
			"inquiry_sg" => array("board", "search"),
			"subscribe_sg" => array("board", "search"),
			"faq_en" => array("board", "search"),
			"insights_en" => array("board", "search"),
			"download_en" => array("board", "search"),
			"inquiry_en" => array("board", "search"),
			"subscribe_en" => array("board", "search"),
			"faq_uk_kr" => array("board", "search"),
			"insights_uk_kr" => array("board", "search"),
			"download_uk_kr" => array("board", "search"),
			"inquiry_uk_kr" => array("board", "search"),
			"subscribe_uk_kr" => array("board", "search"),
			"download_log" => array("board", "search"),
			"download_log_en" => array("board", "search"),
		),
		"permalink_table" => array(
			"insights",
			"insights_en",
			"insights_sg",
			"insights_uk_kr",
			"download",
			"download_en",
			"download_sg",
			"download_uk_kr",
			"faq",
			"faq_en",
			"faq_sg",
			"faq_uk_kr",
			"testimonials_en"
		),
		"meta_table" => array(
			"insights",
			"insights_en",
			"insights_sg",
			"insights_uk_kr",
			"testimonials_en"
		)
	);

	$detect = new Mobile_Detect;

	$isMobile = $detect->isMobile();
	$isTablet = $detect->isTablet();

	unset($detect);

	$cfg['youtubeLinkBoard'] = array();

	// SET meta Title & Description

	$parse_url = parse_url(str_replace("/mobile", "", $_SERVER['REQUEST_URI']));
	$tmp_url = explode("/", $parse_url['path']);
	$tmp_url = array_filter($tmp_url);

	$cfg['meta_url'] = array();
	foreach($tmp_url as $value){
		$cfg['meta_url'][] = $value;
	}
	unset($tmp_url);

	if($isMain){
		$cfg['meta_url'][] = "main";
	}

	include_once __DIR__."/config.meta.php";
	include_once __DIR__."/config.main.php";
	include_once __DIR__."/config.application.php";
?>
