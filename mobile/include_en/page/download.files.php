<? 
if($isDownloadMode){
	ob_start();
	 
	$data = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? and seq = 2", array($boardName, $_GET['v']), true);

	$filedir = "/include/data/board/".$boardName."/".$data["saveName"];

	header("Location: $filedir");
	exit;
/*
	if($_SERVER['HTTP_X_REQUESTED_WITH'] != ""){
		$filename = $data["realName"];
	} else {
		$filename = iconv("utf-8", "cp949", $data["realName"]);
	}

	if (file_exists($filedir) && !is_dir($filedir)) {
		force_download($filename, file_get_contents($filedir));
	} else {
	    alert("File not found.");
	}
	*/
}

?>