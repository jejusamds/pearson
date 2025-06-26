<? 
include "../../../core/common.php";
adminCheck();
ob_start();
 
$data = Queryi("SELECT * FROM ".$cfg['db']['prefix']."boardFile WHERE board = ? and no = ?", array($_GET['t'], $_GET['n']));
 
if($_GET['thumb'] == "true"){
    $filedir = $cfg['root'].$cfg['dir']['board']."/".$_GET['t']."/thumbnail/thumbnail_".$data[0]["saveName"];
} else {
    $filedir = $cfg['root'].$cfg['dir']['board']."/".$_GET['t']."/".$data[0]["saveName"];
}

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