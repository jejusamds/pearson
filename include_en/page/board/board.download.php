<? 
	include_once __DIR__."/../../lib/common.php";
	 
	ob_start();
	 
	$tableName = $cfg['db']['prefix']."boardFile";
	$data = Queryi("SELECT * FROM $tableName WHERE board = ? and no = ?", array($_GET['b'], $_GET['n']));
	 
	$filedir = "../../../include_kr/admin/views/board/upload/".$_GET['b']."/".$data[0]["saveName"];
	$filename = iconv("utf-8", "cp949", $data[0]["realName"]);
	 
	if (file_exists($filedir) && !is_dir($filedir)) {
	    if(preg_match("/msie/", $_SERVER[HTTP_USER_AGENT]) && preg_match("/5\.5/", $_SERVER[HTTP_USER_AGENT])) {
		header("content-type: doesn/matter");
		header("content-length: ".filesize("$filedir"));
		header("content-disposition: attachment; filename=\"$filename\"");
		header("content-transfer-encoding: binary");
	    } else {
		header("content-type: file/unknown");
		header("content-length: ".filesize("$filedir"));
		header("content-disposition: attachment; filename=\"$filename\"");
		header("content-description: php generated data");
	    }
	    header("pragma: no-cache");
	    header("expires: 0");
	    flush();
	 
	    if (is_file("$filedir")) {
		$fp = fopen("$filedir", "rb");
	 
		while(!feof($fp)) {
		    echo fread($fp, 100*1024);
		    flush();
		}
		fclose ($fp);
		flush();
	    } else {
		alert("해당 파일이나 경로가 존재하지 않습니다.");
	    }
	 
	} else {
	    alert("파일을 찾을 수 없습니다.");
	}
?>