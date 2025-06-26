<?
	$cfg['page_code'] = "insights";
	include_once __DIR__."/../lib/common.php";

    

	$boardName = "insights_en";
	$tableName = $cfg['db']['prefix']."board_".$boardName;
	$fileTableName = $cfg['db']['prefix']."boardFile";
	$pageDir = "/insights/";

	// 301 Redirect
	if($_GET['v'] != ""){
		$redirect_self = Queryi("SELECT permalink FROM $tableName WHERE no = ?", array($_GET['v']), true);

		if($redirect_self['permalink'] != ""){
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: ".$cfg['href']."/insights/".$redirect_self['permalink']."/"); 
			exit();
		} else {
			alert("It's an abnormal approach.");
		}
	}

	$boardCoreOnly = true;

	include_once __DIR__."/board/board.core.php";

	if($_GET['v'] != "" || $_GET['pl'] != ""){
		if($_COOKIE[md5("cki_".$boardName."_".$self['no']."_hit")] != base64_encode($self['no'])){
			try{
				Queryi("UPDATE $tableName SET hit = hit + 1 WHERE no = ?", array($self['no']));
			} catch(PDOException $e){
				print_r($e->getMessage());
			}
			setcookie(md5("cki_".$boardName."_".$self['no']."_hit"), base64_encode($self['no']), time() + (86400 * 36500), "/", $_SERVER["SERVER_NAME"]);
		}

//		$meta_title = $self['meta_title'].$cfg['meta_site_title']['division'].$cfg['meta_site_title'][$meta_lang];
		$meta_title = $self['meta_title'];
		$meta_description = $self['meta_description'];
	}

	include_once __DIR__."/../header.php";

	if($_GET['v'] != "" || $_GET['pl'] != ""){
		include_once __DIR__."/board/skin.view.".$cfg['board']['skin']['view'][$boardName].".php";
	} else {
		include_once __DIR__."/board/skin.list.".$cfg['board']['skin']['list'][$boardName].".php";
	}

	include_once __DIR__."/../footer.php";
?>