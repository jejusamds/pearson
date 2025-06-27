<?
	include_once __DIR__."/../lib/common.php";

	$xml = "<?xml version='1.0' encoding='UTF-8'?>";
	$xml .= "<rss version='2.0'>";
	$xml .= "<channel>";

	$lang = "en";

	$xml .= "<title>".$cfg['meta_per_url'][$lang]['main']['title']."</title>";
	$xml .= "<link>https://".$_SERVER['SERVER_NAME']."/</link>";
	$xml .= "<description>".$cfg['meta_per_url'][$lang]['main']['description']."</description>";
	$xml .= "<language>en-us</language>";

	$tableName = $cfg['db']['prefix']."board_insights_en";
	$where = " isDelete = 'N' AND isSecret = 'N' ";
	$orderBy = " regDate DESC";

	$params = array();

	$rs = Queryi("SELECT * FROM $tableName WHERE $where ORDER BY $orderBy", $params);

	for($i = 0; $i < count($rs); $i++){
		$row = $rs[$i];
		$xml .= "<item>";
		$xml .= "<title>".$row['meta_title']."</title>";
		$xml .= "<link>https://".$_SERVER['SERVER_NAME']."/insights/".$row['permalink']."/</link>";
		$xml .= "<description>".$row['meta_description']."</description>";
		$xml .= "</item>";
	}

	$xml .= "</channel>";
	$xml .= "</rss>";

	header('Content-type: text/xml');
	echo preg_replace("/&(?!#?[a-z0-9]+;)/", "&amp;",$xml);
?>