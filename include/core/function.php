<?php
function Queryi($query, $params = array(), $isAssoc = false){
	global $mysqli;
	try {
		$stmt = $mysqli->prepare($query);
		$type = explode(" ", trim($query));

		switch(strtoupper($type[0])){
			case "SELECT" : 
				$stmt->execute($params);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($isAssoc){
					$rs = $rs[0];
				}
				break;
			case "INSERT" : 
				$rs['isInsert'] = $stmt->execute($params);
				$rs['lastInsertId'] = $mysqli->lastInsertId();
				break;
			default :
				$rs['isSuccess'] = $stmt->execute($params);
				break;
		}
	
		return $rs;
	} catch(PDOException $e){
		print_r("errorCode[" . $e->getCode()."] -> ".$query);
		print_r("<br />errorMessage -> ".$e->getMessage());
		exit;
	}
}

function convQstr($arr){
	$str = ""; $add = "/";
	if(count($arr) > 0){
		foreach($arr as $ix => $value){
			if($value != ""){
				$str .= urlencode($value).$add;
			}
		}
	}

	return $str;
}

function encodeDataForce($object = ""){
	global $cfg;

	if($object){
		return @openssl_encrypt($object, "AES-256-CBC", $cfg['forced_crypto_secret_key'], 0, $cfg['forced_crypto_iv']);
	} else {
		return "";
	}
}

function decodeDataForce($object = ""){
	global $cfg;

	if($object){
		return @openssl_decrypt($object, "AES-256-CBC", $cfg['forced_crypto_secret_key'], 0, $cfg['forced_crypto_iv']);
	} else {
		return "";
	}
}

function getQstrCustom($keys, $values){
	$str = "";
	foreach($keys as $key){
		$str .= "&".$key."=".urlencode($values[$key]);
	}

	return $str;
}

function getQstr($data, $type){
	global $cfg;

	$str = "";

	if(gettype($data) == "array"){
		$paramsArr = $data;
	} else {
		if(isset($cfg['qstr'][$data])){
			$paramsArr = $cfg['qstr'][$data];
		} else {
			$paramsArr = $cfg['board']['qstr'][$data];
		}
	}

	if(count($paramsArr) > 0){
		foreach($paramsArr as $value){
			$str .= "&".$value."=".$type[$value];
		}
	}

	return $str;
}

function loginSession($tableName, $id, $password){
	$massword = md5($password);
	$where = "where id = ? and password = ?";
	$query = "select * from $tableName $where";

	$rs = Queryi($query, array($id, $massword));

	if(count($rs) > 0){
		$_SESSION['userLevel'] = $rs[0]['level'];
		$_SESSION['userName'] = $rs[0]['name'];
		$_SESSION['userid'] = $rs[0]['id'];

		return true;
	} else {
		return false;
	}
}

function yamahaLoginCheck($message = "", $redirect = "/"){
	global $_SESSION, $cfg;

	if($_SESSION[$cfg['session_names']['id']] == ""){
		return false;
	} else {
		return true;
	}
}

function adminCheck($level = 100, $isReturn = false){
	global $cfg, $_SESSION;

	if($_SESSION['userLevel'] < $level && $isReturn){
		return false;
	} elseif ($_SESSION['userLevel'] < $level && !$isReturn){
		session_destroy();
		alert("세션이 만료되었거나 비정상적인 접근입니다. 다시 로그인해주세요.", $cfg['baseUrl']."/admin/index.php");
	} else {
		return true;
	}
}

function print_ri($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function alert($msg='', $url=''){
	$charset = "utf-8";
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$charset\">";
	echo "<script language='javascript'>alert('$msg');";
	if (!$url)
		echo "history.go(-1);";
		echo "</script>";
	if ($url){
		if($url == "close"){
			echo "<script>window.close();</script>";
		} else {
			redirectUrl($url);
		}
	}
	exit;
}

function redirectUrl($url = -2){
	if ($url == -1){
		echo "<script>history.go(-1);</script>";
	} elseif ($url == -2){
		echo "<script>history.go(-2);</script>";
	} else {
		echo "<script>location.replace('$url');</script>";
	}

	exit;
}

function getRegularClass($str, $divi = " "){
	$rv = "";

	if (!preg_match('/[^A-Za-z0-9]/', $str)){
		$rv .= $divi."eng";
	}

	if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $str)){
		$rv .= $divi."kor";
	}

	return $rv;
}

function cut_str($str, $len, $suffix = "…", $charset = 'UTF-8'){
	if($charset == "UTF-8"){
		$str = trim(str_replace("\xc2\xa0", "", html_entity_decode($str, ENT_COMPAT, $charset)));
	} else {
		$str = trim(str_replace("\xc2\xa0", "", html_entity_decode(iconv('UTF-8', 'ISO-8859-1', $str), ENT_COMPAT, $charset)));
	}

	$s = mb_substr($str, 0, $len, $charset);

	$cnt = 0;

	for ($i=0; $i < strlen($s); $i++){
		if(ord($s[$i]) > 127){
			$cnt++;
		}
	}

	if (strlen($s) >= strlen($str)){
		$suffix = "";
	}

	$s = trim($s);

	return $s . $suffix;
}

function getIP() { // ip 주소 받기
	$onlineip = '';
	if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), 'unknown' )) {
		$onlineip = getenv ( 'HTTP_CLIENT_IP' );
	} elseif (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), 'unknown' )) {
		$onlineip = getenv ( 'HTTP_X_FORWARDED_FOR' );
	} elseif (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), 'unknown' )) {
		$onlineip = getenv ( 'REMOTE_ADDR' );
	} elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], 'unknown' )) {
		$onlineip = $_SERVER ['REMOTE_ADDR'];
	}
	return $onlineip;
}


function mobile_user_agent_switch(){ // 모바일 device 체크
	$device = '';

	if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
		$device = "ipad";
	} elseif( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
		$device = "iphone";
	} elseif( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
		$device = "blackberry";
	} elseif( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
		$device = "android";
	} else{
		$device ="pc or undefined";
	}

	if( $device ) {
		return $device;
	} return false; {
		return false;
	}
}

function getOS() { // 유저 os 체크
	$os_platform = "Unknown OS Platform";
	$os_array = array('/windows nt 10/i'      =>  'Windows 10',
							'/windows nt 6.3/i'     =>  'Windows 8.1',
							'/windows nt 6.2/i'     =>  'Windows 8',
							'/windows nt 6.1/i'     =>  'Windows 7',
							'/windows nt 6.0/i'     =>  'Windows Vista',
							'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows XP',
							'/windows xp/i'         =>  'Windows XP',
							'/windows nt 5.0/i'     =>  'Windows 2000',
							'/windows me/i'         =>  'Windows ME',
							'/win98/i'              =>  'Windows 98',
							'/win95/i'              =>  'Windows 95',
							'/win16/i'              =>  'Windows 3.11',
							'/macintosh|mac os x/i' =>  'Mac OS X',
							'/mac_powerpc/i'        =>  'Mac OS 9',
							'/linux/i'              =>  'Linux',
							'/ubuntu/i'             =>  'Ubuntu',
							'/iphone/i'             =>  'iPhone',
							'/ipod/i'               =>  'iPod',
							'/ipad/i'               =>  'iPad',
							'/android/i'            =>  'Android',
							'/blackberry/i'         =>  'BlackBerry',
							'/webos/i'              =>  'Mobile');
	foreach ($os_array as $regex => $value) {
		if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
			$os_platform    =   $value;
		}
	}

	return $os_platform;
}



function get_client_browser() { // 유저 browser 체크
	if (stristr ( $_SERVER ["HTTP_USER_AGENT"], "rv:11" )) {
		$browser = "Internet Explorer 11.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "MSIE 10.0" )) {
		$browser = "Internet Explorer 10.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "MSIE 9.0" )) {
		$browser = "Internet Explorer 9.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "MSIE 8.0" )) {
		$browser = "Internet Explorer 8.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "MSIE 7.0" )) {
		$browser = "Internet Explorer 7.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "MSIE 6.0" )) {
		$browser = "Internet Explorer 6.0";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Firefox/6" )) {
		$browser = "Firefox 6";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Firefox/5" )) {
		$browser = "Firefox 5";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Firefox/4" )) {
		$browser = "Firefox 4";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Firefox/3" )) {
		$browser = "Firefox 3";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Firefox/2" )) {
		$browser = "Firefox 2";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Chrome" )) {
		$browser = "Google Chrome";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Safari" )) {
		$browser = "Safari";
	} elseif (stristr ( $_SERVER ["HTTP_USER_AGENT"], "Opera" )) {
		$browser = "Opera";
	} else {
		$browser = "기타";
	}
	return $browser;
}

function basicFileUpload($fileTable, $file, $fileDirectory, $tno, $seq) {
	if ($file["name"]){
		$isAlready = Queryi("SELECT * FROM $fileTable WHERE tno = ? and seq = ?", array($tno, $seq));
		if($isAlready) {
			@unlink($fileDirectory."/".$isAlready[0]["saveName"]);
		}

		$uploadFileRename = fileUpload($file, $fileDirectory);

		$dataSet = "tno= ?,
					seq = ?,
					saveName = '$uploadFileRename',
					realName = '".$file['name']."'";

		if($isAlready){
			Queryi("UPDATE $fileTable SET $dataSet WHERE no = ?", array($tno, $seq, $isAlready[0]['no']));
		} else {
			Queryi("INSERT INTO $fileTable SET $dataSet", array($tno, $seq));
		}

		return $uploadFileRename;
	}
}

function createThumb($directory, $imageName, $optionWidth = "", $optionHeight = ""){
	if($optionWidth != "" || $optionHeight != ""){
		if(!is_dir($directory)){
			$oldmask = umask(0);
			mkdir($directory, 0777, true);
			umask($oldmask);
		} else {
			$oldmask = umask(0);
			chmod($directory, 0777);
			umask($oldmask);
		}

		if(!is_dir($directory."/thumbnail")) {
			$oldmask = umask(0);
			mkdir($directory."/thumbnail", 0777, true);
			chmod($directory."/thumbnail", 0777);
			umask($oldmask);
		}

		$imageNameArray = explode(".", $imageName);
		$imageExtension = strtolower($imageNameArray[count($imageNameArray)-1]);

		$imgSource = $directory."/".$imageName;
		if(is_file($imgSource) && file_exists($imgSource)){
			if ($imageExtension == 'gif'){
				$image = imagecreatefromgif($imgSource);
			} else if($imageExtension == 'jpeg' || $imageExtension == 'jpg'){
				$image = imagecreatefromjpeg($imgSource);
			} else if ($imageExtension == 'png'){
				$image = imagecreatefrompng($imgSource);
			}

			$thumbnailFullPath = $directory."/thumbnail/thumbnail_".$imageName;

			$width = imagesx($image);
			$height = imagesy($image);

			if($optionWidth == ""){
				$optionWidth = ceil(($optionsHeight * $width) / $height);
			}
			if($optionHeight == ""){
				$optionHeight = ceil(($optionWidth * $height) / $width);
			}

			$original_aspect = $width / $height;
			$thumb_aspect = $optionWidth / $optionHeight;

			if ( $original_aspect >= $thumb_aspect ){
				$new_height = $optionHeight;
				$new_width = $width / ($height / $optionHeight);
			} else {
				$new_width = $optionWidth;
				$new_height = $height / ($width / $optionWidth);
			}

			$thumb = imagecreatetruecolor($optionWidth, $optionHeight);

			switch ($imageExtension){
				case "png":
					$background = imagecolorallocate($thumb, 0, 0, 0);
					imagecolortransparent($thumb, $background);
					imagealphablending($thumb, false);
					imagesavealpha($thumb, true);
					break;
				case "gif":
					$background = imagecolorallocate($thumb, 0, 0, 0);
					imagecolortransparent($thumb, $background);
					break;
			}

			imagecopyresampled($thumb, $image, 0 - ($new_width - $optionWidth) / 2, 0 - ($new_height - $optionHeight) / 2, 0, 0, $new_width, $new_height, $width, $height);

			if ($imageExtension == 'gif'){
				imagegif($thumb, $thumbnailFullPath);
			} else if($imageExtension == 'jpeg' || $imageExtension == 'jpg'){
				imagejpeg($thumb, $thumbnailFullPath, 100);
			} else if ($imageExtension == 'png'){
				imagepng($thumb, $thumbnailFullPath);
			}

			return "thumbnail_".$imageName;
		} else {
			return false;
		}
	} else {
		echo "createThumb params error";
		exit;
	}
}

function boardFileUpload($fileTable, $file, $fileDirectory, $board, $tno, $seq) {
	if ($file["name"]){
		if(!is_dir($fileDirectory)){
			$oldmask = @umask(0);
			@mkdir($fileDirectory, 0777, true);
			@umask($oldmask);
		} else {
			$oldmask = @umask(0);
			@chmod($fileDirectory, 0777);
			@umask($oldmask);
		}
		$isAlready = Queryi("SELECT * FROM $fileTable WHERE board = ? and tno = ? and seq = ?", array($board, $tno, $seq));

		if($isAlready) {
			@unlink($fileDirectory."/".$isAlready[0]["saveName"]);
		}

		$uploadFileRename = fileUpload($file, $fileDirectory);

		$dataSet = "board = ?,
					tno = ?,
					seq = ?,
					saveName = ?,
					realName = ?";

		if($isAlready){
			Queryi("UPDATE $fileTable SET $dataSet WHERE no = ?", array($board, $tno, $seq, $uploadFileRename, $file['name'], $isAlready[0]['no']));
		} else {
			Queryi("INSERT INTO $fileTable SET $dataSet", array($board, $tno, $seq, $uploadFileRename, $file['name']));
		}

		return $uploadFileRename;
	}
}

function otherFileUpload($fileTable, $file, $fileDirectory, $kind, $tno, $seq) {
	if ($file["name"]){
		if(!is_dir($fileDirectory)){
			$oldmask = umask(0);
			@mkdir($fileDirectory, 0777, ture);
			umask($oldmask);
		} else {
			$oldmask = umask(0);
			@chmod($fileDirectory, 0777);
			umask($oldmask);
		}

		$isAlready = Queryi("SELECT * FROM $fileTable WHERE tno = ? and seq = ?", array($tno, $seq));

		if($isAlready) {
			@unlink($fileDirectory."/".$isAlready[0]["saveName"]);
		}

		$uploadFileRename = fileUpload($file, $fileDirectory);

		$dataSet = "
					kind = ?,
					tno = ?,
					seq = ?,
					saveName = ?,
					realName = ?";

		if($isAlready){
			Queryi("UPDATE $fileTable SET $dataSet WHERE no = ?", array($kind, $tno, $seq, $uploadFileRename, $file['name'], $isAlready[0]['no']));
		} else {
			Queryi("INSERT INTO $fileTable SET $dataSet", array($kind, $tno, $seq, $uploadFileRename, $file['name']));
		}

		return $uploadFileRename;
	}
}

function fileUpload($file, $fileDirectory){
	$tempUploadfile = str_replace(" ","",$file["name"]);
	$tempUploadFile = preg_replace("/\.(xml|php4|php3|jsp|dll|php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-spam", $tempUploadfile);

	$uploadFile = explode(".",$tempUploadFile);
	$uploadTotal = count($uploadFile) - 1;
	$uploadFileRename = str_replace('%', '', urlencode($uploadFile[0])).'_'.substr(md5(uniqid($now)),0,8).".".$uploadFile[$uploadTotal];

	$isAlreadyName = $fileDirectory.$uploadFileRename;
	for($i = 1; file_exists($isAlreadyName); $i++) {
		$uploadFileRename = str_replace('%', '', urlencode($uploadFile[0])).'_'.substr(md5(uniqid($now)),0,8)."_($i).".$uploadFile[$uploadTotal];
		$isAlreadyName = $fileDirectory.$uploadFileRename;
	}

	if ($uploadFileRename == "") {
		return false;
	}

	if(!is_dir($fileDirectory)){
		$oldmask = umask(0);
		mkdir($fileDirectory, 0777, true);
		umask($oldmask);
	}

	move_uploaded_file($file["tmp_name"], $fileDirectory."/".$uploadFileRename);
	$oldmask = umask(0);
	chmod($fileDirectory."/".$uploadFileRename, 0777);
	umask($oldmask);
	return $uploadFileRename;
}

function fileDelete($fileTable, $fileDirectory, $no){
	$selfData = Queryi("SELECT * FROM $fileTable WHERE no = ?", array($no));

	@unlink($fileDirectory."/".$selfData[0]['saveName']);
	@unlink($fileDirectory."/thumbnail/thumbnail_".$selfData[0]['saveName']);

	Queryi("DELETE FROM $fileTable WHERE no = ?", array($no));
}

function get_text($str, $html=0){
	if ($html == 0) {
		$str = preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
	}

	$source[] = "/</";
	$target[] = "&lt;";
	$source[] = "/>/";
	$target[] = "&gt;";
	$source[] = "/\'/";
	$target[] = "&#039;";

	if ($html) {
		$source[] = "/\n/";
		$target[] = "<br/>";
	}

	return preg_replace($source, $target, $str);
}

function sendMail($fname, $fmail, $to, $subject, $content, $type=2, $file="", $charset="UTF-8", $cc="", $bcc="") {
	$toemch = explode("@", $to);
	$to = "$toemch[0]@$toemch[1]";
	$fremch = explode("@", $fmail);
	$fmail = "$fremch[0]@$fremch[1]";
	$fname   = "=?$charset?B?" . base64_encode($fname) . "?=";
	$subject = "=?$charset?B?" . base64_encode($subject) . "?=";
	$charset = ($charset != "") ? "charset=$charset" : "";
	$header  = "Return-Path: <$fmail>\n";
	$header .= "From: $fname <$fmail>\n";
	$header .= "Reply-To: <$fmail>\n";
	if ($cc)  $header .= "Cc: $cc\n";
	if ($bcc) $header .= "Bcc: $bcc\n";
	$header .= "MIME-Version: 1.0\n";

	$header .= "X-Mailer: Mailer ($_SERVER[HTTP_HOST]) : $_SERVER[SERVER_ADDR] : $_SERVER[REMOTE_ADDR] : : $_SERVER[PHP_SELF] : $_SERVER[HTTP_REFERER] \n";

	if ($file != "") {
		$boundary = uniqid("http://".$_SERVER['HTTP_HOST']."/");

		$header .= "Content-type: MULTIPART/MIXED; BOUNDARY=\"$boundary\"\n\n";
		$header .= "--$boundary\n";
	}

	if ($type) {
		$header .= "Content-Type: TEXT/HTML; $charset\n";
	if ($type == 2)
		$content = nl2br($content);
	} else {
		$header .= "Content-Type: TEXT/PLAIN; $charset\n";
		$content = stripslashes($content);
	}

	$header .= "Content-Transfer-Encoding: BASE64\n\n";
	$header .= chunk_split(base64_encode($content)) . "\n";

	if ($file != "") {
		foreach ($file as $f) {
			$header .= "\n--$boundary\n";
			$header .= "Content-Type: APPLICATION/OCTET-STREAM; name=\"$f[name]\"\n";
			$header .= "Content-Transfer-Encoding: BASE64\n";
			$header .= "Content-Disposition: inline; filename=\"$f[name]\"\n";

			$header .= "\n";
			$header .= chunk_split(base64_encode($f[data]));
			$header .= "\n";
		}
		$header .= "--$boundary--\n";
	}

	mail($to, $subject, "", $header);
}


function clean_string($string) {

	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);

}


function attach_file($name, $file) {

	$fp = fopen($file, "r");

	$tmpfile = array(
		"name" => $name,
		"data" => fread($fp, filesize($file))
	);

	fclose($fp);

	return $tmpfile;
}

function encodingString($str){
	$arr = str_split($str);
	$result = "";
	for($i = 0; $i < count($arr); $i++){
		if($i >= (count($arr) / 2 )){
			$result .= "*";
		} else {
			$result .= $arr[$i];
		}
	}

	return $result;
}

function getDomain($url){
	$pieces = parse_url($url);
	$domain = isset($pieces['host']) ? $pieces['host'] : '';
	if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
		return $regs['domain'];
	}

	return false;
}

function arrayShake($arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $length = 6){
	$str = "";
	for($i = 0; $i < 6; $i++){
		$randIndex = array_rand($arr);
		$str .= $arr[$randIndex];
	}

	return $str;
}

function imageToFancybox($txt){
	preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $txt, $matches);

	$newMatches = array();
	foreach($matches[0] as $key => $value){
		array_push($newMatches, '<a class="fancybox" href="'.$matches[1][$key].'"><img src="'.$matches[1][$key].'"></a>');
	}

	foreach($matches[0] as $key => $value){
		$txt = str_replace($matches[0][$key], $newMatches[$key], $txt);
	}

	return $txt;
}

function getPageBtns($dataCount, $nowPage, $maxPage, $maxBlock, $url, $add=""){
	$str = "";

	$pageCount =  ceil($dataCount / $maxPage); // 5
	$maxBlockCount = ceil($pageCount / $maxBlock); // 3

	$startIndex = ($maxBlock * floor(($nowPage-1) / $maxBlock))+1;
	$endIndex = $startIndex + $pageCount - 1;

	$nowBlock = ceil($startIndex / $maxBlock);

	if($nowBlock > 1){
		$str .= "<li class=\"next\"><a href=\"". $url . "1" . $add ."\"><span class=\"fa fa-angle-double-left\"></span></a></li>";
		$str .= "<li class=\"next\"><a href=\"". $url . ($nowPage - $maxBlock). $add ."\"><span class=\"fa fa-angle-left\"></span></a></li>";
	}

	for($i = 0; $i < $maxBlock; $i++){
		if(($startIndex + $i) <= $pageCount){
			if ($nowPage != ($startIndex + $i)){
				$str .= "<li><a href='".$url.($startIndex+$i).$add."' style='height:33px;'>".($startIndex+$i)."</a></li>";
			} else {
				$str .= "<li class=\"active\"><a href='javascript:void(0)' style='height:33px;'>".($startIndex+$i)."</a></li>";
			}
		}
	}
	if($nowBlock < $maxBlockCount){
		$str .= "<li class=\"next\"><a href=\"". $url . (($nowBlock*$maxBlock)+1) . $add ."\"><span class=\"fa fa-angle-right\"></span></a></li>";
		$str .= "<li class=\"next\"><a href=\"". $url . $pageCount. $add ."\"><span class=\"fa fa-angle-double-right\"></span></a></li>";
	}

	return $str;
}

function getBoardPageBtns($dataCount, $nowPage, $maxPage, $maxBlock, $addQstr = ""){
	global $_GET, $pageDir, $cfg;

	if(strpos($addQstr, "?") === false){
		$addQstr = "?".$addQstr;
	}

	$str = '<div class="pagination">';

	$pageCount =  @ceil($dataCount / $maxPage);
	$maxBlockCount = @ceil($pageCount / $maxBlock);

	$startIndex = @($maxBlock * floor(($nowPage-1) / $maxBlock))+1;
	$endIndex = $startIndex + $pageCount - 1;

	$nowBlock = @ceil($startIndex / $maxBlock);

	if($nowBlock > 1){
		$str .= '<span class="page_btn btn_l">';
		$str .= '<a class="first" href="'.$cfg['href'].$pageDir.$addQstr.'1">처음페이지</a>';
		$str .= '<a class="prev" href="'.$cfg['href'].$pageDir.$addQstr.($nowPage - $maxBlock).'">이전페이지</a>';
		$str .= '</span>';
	} else {
		$str .= '<span class="page_btn btn_l">';
		$str .= '<a class="first" href="javascript:void(0);">처음페이지</a>';
		$str .= '<a class="prev" href="javascript:void(0);">이전페이지</a>';
		$str .= '</span>';
	}

	$str .= '<span class="page_num">';
	if($dataCount == 0){
		$str .= '<span class="num"><a href="javascript:void(0);">1</a></span>';
	} else {
		for($i = 0; $i < $maxBlock; $i++){
			if(($startIndex + $i) <= $pageCount){
				if ($nowPage != ($startIndex + $i)){
					$str .= '<span class="num"><a href="'.$cfg['href'].$pageDir.$addQstr.($startIndex+$i).'">'.($startIndex+$i).'</a></span>';
				} else {
					$str .= '<span class="num on"><a href="javascript:void(0)">'.($startIndex+$i).'</a></span>';
				}
			}
		}
	}
	$str .= '</span>';

	if($nowBlock < $maxBlockCount){
		$str .= '<span class="page_btn btn_r">';
		$str .= '<a class="next" href="'.$cfg['href'].$pageDir.$addQstr.(($nowBlock*$maxBlock)+1).'">다음페이지</a>';
		$str .= '<a class="last" href="'.$cfg['href'].$pageDir.$addQstr.$pageCount.'">마지막페이지</a>';
		$str .= '</span>';
	} else {
		$str .= '<span class="page_btn btn_r">';
		$str .= '<a class="next" href="javascript:void(0);">다음페이지</a>';
		$str .= '<a class="last" href="javascript:void(0);">마지막페이지</a>';
		$str .= '</span>';
	}

	$str .= "</div>";

	return $str;
}

function getYoutubeIdentity($url){
	preg_match('/^.*(youtu.be\/|v\/|\/u\/\w\/|embed\/|watch\?)\??v?=?([^#\&\?]*).*/', $url, $matches);
	return $matches[2];
}

function iarray_filter($arr, $search, $type = ""){
	if($type == "key"){
		$option = ARRAY_FILTER_USE_KEY;
	} else {
		$option = ARRAY_FILTER_USE_BOTH;
	}

	return array_filter($arr, function($key) use ($search){
		if(strpos($key, $search) !== false){
			return true;
		} else {
			return false;
		}
	}, $option);
}

function reArrayFiles() {
	global $_POST, $_FILES;

	$fileArr = array();
	for($i = 0; $i < count($_POST['fileseq']); $i++){
		if(isset($_FILES['uploadfile'.($i + 1)])){
			array_push($fileArr, $_FILES['uploadfile'.($i + 1)]);
		} else {
			array_push($fileArr, array());
		}
	}

	return $fileArr;
}

function files_sort_to_array($files_name = "uploadfile") {
	global $_POST, $_FILES;

	$fileArr = array();
	$fileSeqMax = count($_FILES[$files_name]['name']);

	for($i = 1; $i <= $fileSeqMax; $i++){
		if(isset($_FILES[$files_name]['name'][$i - 1])){
			$fileArr[$i - 1] = array(
				"name" => $_FILES[$files_name]['name'][$i - 1],
				"type" => $_FILES[$files_name]['type'][$i - 1],
				"tmp_name" => $_FILES[$files_name]['tmp_name'][$i - 1],
				"error" => $_FILES[$files_name]['error'][$i - 1],
				"size" => $_FILES[$files_name]['size'][$i - 1],
				);
		} else {
			$fileArr[$i - 1] = array();
		}
	}

	ksort($fileArr);

	return $fileArr;
}

function files_to_stringify($files, $options){
	if($options['upload_dir'] == ""){
		echo 'undefined fileDirectory params.';
		exit;
	}

	$uploaded_files = array();
	for($i = 0; $i < count($files); $i++){
		if($options['overwrite_name'] != "" && $_POST[$options['overwrite_name']."_".($i + 1)] != ""){

			$uploaded_files[$i] = $_POST[$options['overwrite_name']."_".($i + 1)];
		}

		$data = $files[$i];
		$createdFileName = "";

		if($data['name'] != ""){
			$createdFileName = fileUpload($data, $options['upload_dir']);

			if($createdFileName != ""){
				$uploaded_files[$i] = $createdFileName."^^".$data['name'];
			}

			if($options['create_thumb'] && $createdFileName != ""){
				createThumb($options['upload_dir'], $createdFileName, $options['thumb_width'], $options['thumb_height']);
			}
		} else {
			if($uploaded_files[$i] == ""){
				$uploaded_files[$i] = "";
			}
		}
	}

	return implode("|", $uploaded_files);
}

function files_string_to_explode($files, $options = array("separator" => array("|", "^^"))){
	$explode_files = explode($options['separator'][0], $files);

	$res = array();
	for($k = 0; $k < count($explode_files); $k++){
		$res[$k] = array();

		if($explode_files[$k] != ""){
			$tmp = explode($options['separator'][1], $explode_files[$k]);

			$res[$k]['seq'] = $k + 1;
			$res[$k]['save_name'] = $tmp[0];
			$res[$k]['real_name'] = $tmp[1];
		}
	}

	return $res;
}

function string_to_explode($string, $options = array("separator" => array("|", "^^"))){
	$explode_files = explode($options['separator'][0], $string);

	if(count($options['separator']) > 1){
		$res = array();
		for($k = 0; $k < count($explode_files); $k++){
			$res[$k] = array();

			if($explode_files[$k] != ""){
				$tmp = explode($options['separator'][1], $explode_files[$k]);

				$res[$k][] = $tmp[0];
				$res[$k][] = $tmp[1];
			}
		}
	} else {
		$res = $explode_files;
	}

	return $res;
}

function https_curl_get($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_PORT , 443); 
	$return = curl_exec($curl);
	curl_close($curl);
	return $return;
}

function scrape_insta_hash($tag){
//	$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/'); // instagrame tag url
	$instaURI = 'https://www.instagram.com/explore/tags/'.$tag.'/';
	$instach = curl_init();
	curl_setopt($instach, CURLOPT_URL, $instaURI);
	curl_setopt($instach, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($instach, CURLOPT_TIMEOUT, 20);
	$insta_source = curl_exec($instach);
	curl_close($instach);

	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]);
	$insta_array = json_decode($insta_json[0], TRUE);

	return $insta_array;
}

function xml2array($xmlObject, $out = array()){
	if(strpos($xmlObject, ".xml") !== false){
		$xmlObject = simplexml_load_file($xmlObject);
	} else {
		$xmlObject = simplexml_load_string($xmlObject);
	}

	$rv = json_decode(json_encode((array)$xmlObject),1);

	return $rv;
}

function getLanguage(){
	global $_SERVER;

	if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])){
		$max   = 0.0;
		$langs = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);

		foreach($langs as $lang){
			$lang = explode(';', $lang);
			$q = (isset($lang[1])) ? ((float) $lang[1]) : 1.0;
			if ($q > $max){
				$max = $q;
				$preferred = $lang[0];
			}
		}
		$preferred = trim($preferred);
	}

	return $preferred;
}

function isActive($req){
	global $cfg;

	if(isset($cfg['page_code'])){
		$page_code = explode("/", $cfg['page_code']);

		if(is_array($req)){
			$arr = $req;
			$len = count($arr);
			for($k = 0; $k < $len; $k++){
				$req = explode("/", $arr[$k]);

				$is_active = false;
				for($i = 0; $i < count($req); $i++){
					if($req[$i] != $page_code[$i]){
						$is_active = false;
						break;
					} else {
						$is_active = true;
					}
				}

				if($is_active){
					break;
				}
			}
		} else {
			$req = explode("/", $req);

			$is_active = false;
			for($i = 0; $i < count($req); $i++){
				if($req[$i] != $page_code[$i]){
					$is_active = false;
					break;
				} else {
					$is_active = true;
				}
			}
		}
		
		return (($is_active) ? 'active' : '');
	}
}

function isActiveCustom($req, $key, $val){
	global $cfg, $_GET;

	if(isset($cfg['page_code'])){
		$page_code = explode("/", $cfg['page_code']);

		if(is_array($req)){
			$arr = $req;
			$len = count($arr);
			for($k = 0; $k < $len; $k++){
				$req = explode("/", $arr[$k]);

				$is_active = false;
				for($i = 0; $i < count($req); $i++){
					if($req[$i] != $page_code[$i]){
						$is_active = false;
						break;
					} else {
						$is_active = true;
					}
				}

				if($is_active){
					break;
				}
			}
		} else {
			$req = explode("/", $req);

			$is_active = false;
			for($i = 0; $i < count($req); $i++){
				if($req[$i] != $page_code[$i]){
					$is_active = false;
					break;
				} else {
					$is_active = true;
				}
			}
		}
		
		return (($is_active && $_GET[$key] == $val) ? 'active' : '');
	}
}

function encodeData($str = ""){
	global $cfg;
	if($str != ""){
		$rs = Queryi("SELECT (HEX(AES_ENCRYPT('".$str."', '".$cfg['public_key']."'))) as val");

		return $rs[0]['val'];
	}
}

function decodeData($str = ""){
	global $cfg;
	if($str != ""){
		$rs = Queryi("SELECT AES_DECRYPT(UNHEX('".$str."'), '".$cfg['public_key']."') as val");

		return $rs[0]['val'];
	}
}

function domainCheck(){
	global $_SERVER, $cfg;

	if(in_array(getDomain($_SERVER['HTTP_REFERER']), $cfg['domains'])){
		return true;
	} else {
		return false;
	}
}

function checkAccessIP(){
	global $cfg;

	if($cfg['access_ip_usable']){
		if(in_array(getIP(), $cfg['access_ip'])){
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

function createToken(){
	$token = uniqid("", true);

	$token = strtolower(encodeData(mt_rand(0, 99999999).substr($token, 0, strlen($token) / 2)));

	return $token;
}

function setBrowserCache($path){
	global $cfg;

	return $cfg['baseUrl'].$path."?cc=".date("sYHmid", filemtime($_SERVER['DOCUMENT_ROOT'].$cfg['baseUrl'].$path));
}

function getPermalink($str){
	$str = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $str);
	$str = preg_replace('/\s{2,}/', ' ', $str);
	$str = preg_replace('/ /', '-', $str);

	return $str;
}

function embeddedContent($txt){
	if(strpos($txt, "<img") !== false){
		// max-width 추가
		preg_match_all('/<img[^>]+style="([^">]+)"/', $txt, $styles);
		if($styles[1]){
			for($i = 0; $i < count($styles[1]); $i++){
				$txt = str_replace($styles[1][$i], "max-width: 100%;", $txt);
			}
		} else {
			$txt = str_replace("<img ", "<img style='max-width: 100%;'", $txt);
		}

		preg_match_all('/<img[^>]+src="([^">]+)"/', $txt, $matches);
	}

	// AddEmbeddedImage cid 추가
	$data = array("cid" => array());
	for($i = 0; $i < count($matches[1]); $i++){
		preg_match('/^(.*?)upLoad\//', $matches[1][$i], $tmp);
		if($tmp){
			$data['cid'][] = array(
				"idx" => "embedimg".$i,
				"src" => __DIR__."/../../../smarteditor/upLoad/".str_replace($tmp[0], "", $matches[1][$i])
			);

			$txt = str_replace($matches[1][$i], "cid:embedimg".$i, $txt);
		} else {
			preg_match('/^(.*?)include_kr\//', $matches[1][$i], $tmp);
			if($tmp){
				$data['cid'][] = array(
					"idx" => "embedimg".$i,
					"src" => $_SERVER['DOCUMENT_ROOT']."/".str_replace($tmp[1], "", $matches[1][$i])
				);

				$txt = str_replace($matches[1][$i], "cid:embedimg".$i, $txt);
			}
		}
	}

	$data['content'] = $txt;

	return $data;
}

function resizeImageAndSave($directory, $standardWidth){
	global $_SERVER;

	$extension = strtolower(pathinfo($directory, PATHINFO_EXTENSION));
	$file_name = "thumb_".uniqid()."_".basename($directory);
	$thumb_path = $_SERVER['DOCUMENT_ROOT']."/include_kr/data/insights_thumb";

	if(file_exists($directory)){
		$img_info = getimagesize($directory);

		// 기준 사이즈보다 클 경우 리사이징
		if($img_info[0] > $standardWidth){
			$standardHeight = ($standardWidth * $img_info[1]) / $img_info[0];

			if ($extension == 'gif'){
				$image = imagecreatefromgif($directory);
			} elseif ($extension == 'jpeg' || $extension == 'jpg'){
				$image = imagecreatefromjpeg($directory);
			} else if ($extension == 'png'){
				$image = imagecreatefrompng($directory);
			}

			$width = imagesx($image);
			$height = imagesy($image);

			$thumb = imagecreatetruecolor($standardWidth, $standardHeight);

			imagecopyresampled($thumb, $image, 0, 0, 0, 0, $standardWidth, $standardHeight, $width, $height);

			if ($extension == 'gif'){
				imagegif($thumb, $thumb_path."/".$file_name);
			} else if($extension == 'jpeg' || $extension == 'jpg'){
				imagejpeg($thumb, $thumb_path."/".$file_name, 100);
			} else if ($extension == 'png'){
				imagepng($thumb, $thumb_path."/".$file_name);
			}

			return $thumb_path."/".$file_name;
		} else {
		// 기준 사이즈보다 작을 경우 원본 리턴
			return $directory;
		}
	}
}

function embeddedNewsletterContent($txt){
	if(strpos($txt, "<img") !== false){
		// max-width 추가
		preg_match_all('/<img[^>]+style="([^">]+)"/', $txt, $styles);
		if($styles[1]){
			for($i = 0; $i < count($styles[1]); $i++){
				$txt = str_replace($styles[1][$i], "max-width: 100%;", $txt);
			}
		} else {
			$txt = str_replace("<img ", "<img style='max-width: 100%;'", $txt);
		}

		preg_match_all('/<img[^>]+src="([^">]+)"/', $txt, $matches);
	}

	// AddEmbeddedImage cid 추가
	$data = array("cid" => array());
	for($i = 0; $i < count($matches[1]); $i++){
		preg_match('/^(.*?)upLoad\//', $matches[1][$i], $editor_img);
		if($editor_img){
			$img_path = __DIR__."/../../../smarteditor/upLoad/".str_replace($editor_img[0], "", $matches[1][$i]);
			if(file_exists($img_path)){
				$img_src = resizeImageAndSave($img_path, 600);

				$data['cid'][] = array(
					"idx" => "embedimg".$i,
					"src" => $img_src
				);

				$txt = str_replace($matches[1][$i], "cid:embedimg".$i, $txt);
			}
		} else {
			preg_match('/^(.*?)\include/', $matches[1][$i], $upload_img);

			if($upload_img){
				$img_path = urldecode($_SERVER['DOCUMENT_ROOT']."/".str_replace($upload_img[1], "", $matches[1][$i]));

				if(file_exists($img_path)){
					$img_src = resizeImageAndSave($img_path, 600);
					
					$data['cid'][] = array(
						"idx" => "embedimg".$i,
						"src" => $img_src
					);

					$txt = str_replace($matches[1][$i], "cid:embedimg".$i, $txt);
				}
			}
		}
	}

	$data['content'] = $txt;

	return $data;
}

function generateRandomString($length = 12){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendMailToAdmin($mail_title, $mail_msg, $options = array()){
	global $cfg, $_SESSION;
	
	include_once $_SERVER['DOCUMENT_ROOT']."/include/core/PHPMailer/PHPMailerAutoload.php";

	if($mail_title != "" && $mail_msg != ""){
		try {
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->CharSet = "UTF-8"; 
			$mail->ContentType = "text/html";
			$mail->Host = "smtp-mail.outlook.com";
			$mail->SMTPAuth = true;
			$mail->Username = "hayley@pearsonp.com";
			// $mail->Username = "info@pearsonp.com";
			$mail->Password = "Xot82488";
			// $mail->Password = "How18604";


			$mail->SMTPSecure = "STARTTLS";
			$mail->Port = "587";

/*
			if(isset($options['addCC'])){
				foreach($options['addCC'] as $key => $value){
					$mail->addCC($value['mail'], $value['name']);
				}
			}
*/

			$mail->SetFrom("hayley@pearsonp.com", "Notice");
			$mail->isHTML(true);
			$mail->Subject = $mail_title;

			try {
				$mail->AddAddress("info@pearsonp.com", "info");
				// $mail->AddAddress("nary_2@naver.com", "info");
				$mail->Body = $mail_msg;
				$mail->Send();
			} catch (phpmailerException $e) {
				// print_ri($e);
			} catch(Exception $e){
				// print_ri($e);
			}

			$mail->clearAddresses();

			unset($mail);

			/*
			$mail = new PHPMailer(true);

			$mail->IsSMTP();
			$mail->IsHTML(true);
			$mail->CharSet = "UTF-8"; 
			$mail->ContentType = "text/html";
			$mail->AddAddress("info@pearsonp.com", "Manager");
//			$mail->AddAddress("nary_2@naver.com", "Manager");
//			$mail->AddAddress("injuuney@gmail.com", "Manager");
*/
/*
			if(isset($options['addCC'])){
				foreach($options['addCC'] as $key => $value){
					$mail->addCC($value['mail'], $value['name']);
				}
			}
*/
			/*
			$mail->SetFrom("robot@pearsonp.com", "Notice");
			$mail->isHTML(true);
			$mail->Subject = $mail_title;
			$mail->Body = $mail_msg;
			$mail->Send();
*/
		} catch (phpmailerException $e) {
		} catch(Exaption $e){
		}
	}
}
function isOurIP() { // ip 주소 받기
	$onlineip = '';
	if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), 'unknown' )) {
		$onlineip = getenv ( 'HTTP_CLIENT_IP' );
	} elseif (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), 'unknown' )) {
		$onlineip = getenv ( 'HTTP_X_FORWARDED_FOR' );
	} elseif (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), 'unknown' )) {
		$onlineip = getenv ( 'REMOTE_ADDR' );
	} elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], 'unknown' )) {
		$onlineip = $_SERVER ['REMOTE_ADDR'];
	}

	if($onlineip == "110.14.180.206"){
		return true;
	} else {
		return false;
	}
}
?>