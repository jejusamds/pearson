<?
	include_once __DIR__."/../../lib/common.php";

	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: ".$cfg['href']."/ourservice/bank/");
?>