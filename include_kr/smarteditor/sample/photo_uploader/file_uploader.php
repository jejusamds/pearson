<?php
include_once "../../../lib/mobile_detect.php";
include_once "../../../lib/config.php";

// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$todayFolder = date("Ymd");
		$uploadDir = '../../upLoad/'.$todayFolder.'/';
		if(!is_dir($uploadDir)){
			$oldmask = umask(0);
			mkdir($uploadDir, 0777);
			umask($oldmask);
		}

		$tempUploadfile = str_replace(" ","", $_FILES['Filedata']['name']);

		$denyfile = array("jpg","bmp","jpeg","png", "gif");

		if(in_array($filename_ext, $denyfile)){
			$uploadFile = explode(".",$tempUploadfile);
			$uploadTotal = count($uploadFile) - 1;
			$uploadFileRename =substr(md5(uniqid($now)),0,8).'_'.str_replace('%', '', urlencode($uploadFile[0])).".".$uploadFile[$uploadTotal];

			$isAlreadyName = $uploadDir.$uploadFileRename;
			for($i = 1; file_exists($isAlreadyName); $i++) {
				$uploadFileRename = substr(md5(uniqid($now)),0,8).'_'.str_replace('%', '', urlencode($uploadFile[0]))."_$i.".$uploadFile[$uploadTotal];
				$isAlreadyName = $uploadDir.$uploadFileRename;
			}
			
			$newPath = $uploadDir.$uploadFileRename;
			
			@move_uploaded_file($tmp_name, $newPath);
			
			$url .= "&bNewLine=true";
			$url .= "&sFileName=".$uploadFileRename;
			$url .= "&sFileURL=http://".$_SERVER['SERVER_NAME'].$cfg['baseUrl']."/smarteditor/upLoad/".$todayFolder."/".$uploadFileRename;
		}
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}

header('Location: '. $url);
?>