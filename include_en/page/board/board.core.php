<?
	// 페이지 기억 세션명
	$keep_session_name = 'async_keep_page_'.$boardName;
	
	if($_GET['v'] != "" || $_GET['pl'] != ""){
		$where = " isDelete = 'N' AND isSecret = 'N' ";
		$orderBy = "isNotice DESC, regDate DESC";

		$dataTotal = Queryi("SELECT count(*) as Cnt FROM $tableName WHERE $where");
		$dataCount = $dataTotal[0]['Cnt'];
		$fileDirectory = $cfg['boardDirectory']."/".$boardName;

		if($_GET['pl'] != ""){
			$rs = Queryi("SELECT * FROM $tableName WHERE permalink = ? ORDER BY $orderBy", array($_GET['pl']));
		} elseif($_GET['v'] != ""){
			$rs = Queryi("SELECT * FROM $tableName WHERE no = ? ORDER BY $orderBy", array($_GET['v']));
		}

		if(!$rs){
			exit;
		}

		$self = $rs[0];

		$prev = Queryi("SELECT * FROM $tableName WHERE $where AND regDate > ? ORDER BY regDate ASC Limit 0, 2", array($rs[0]['regDate']));
		$next = Queryi("SELECT * FROM $tableName WHERE $where AND regDate < ? ORDER BY regDate DESC Limit 0, 2", array($rs[0]['regDate']));

		if(count($prev) >= 2 && count($next) >= 1){
			array_pop($prev);
		}

		if(count($next) >= 2 && count($prev) >= 1){
			array_pop($next);
		}

		for($i = 0; $i < count($prev); $i++){
			array_unshift($rs, $prev[$i]);
		}

		for($i = 0; $i < count($next); $i++){
			array_push($rs, $next[$i]);
		}

		for($i = 0; $i < count($rs); $i++){
			if($rs[$i]['no'] == $self['no']){
				$rs[$i]['isSelf'] = true;
			} else {
				$rs[$i]['isSelf'] = false;
			}

			$temp = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? ORDER BY seq ASC", array($boardName, $rs[$i]['no']));

			for($j = 0; $j < count($temp); $j++){
				if($rs[$i]['isSelf']){
					$self['files'][$temp[$j]['seq'] - 1] = $temp[$j];
					$self['files'][$temp[$j]['seq'] - 1]['originalSrc'] = $fileDirectory."/".$temp[$j]['saveName'];
					$self['files'][$temp[$j]['seq'] - 1]['thumbnailSrc'] = $fileDirectory."/thumbnail/thumbnail_".$temp[$j]['saveName'];
				}

				$rs[$i]['files'][$temp[$j]['seq'] - 1] = $temp[$j];
				$rs[$i]['files'][$temp[$j]['seq'] - 1]['originalSrc'] = $fileDirectory."/".$temp[$j]['saveName'];
				$rs[$i]['files'][$temp[$j]['seq'] - 1]['thumbnailSrc'] = $fileDirectory."/thumbnail/thumbnail_".$temp[$j]['saveName'];
			}
		}

		$latest = Queryi("SELECT * FROM $tableName WHERE isDelete = 'N' AND isSecret = 'N' ORDER BY regDate DESC LIMIT 0, 3");
		for($k = 0; $k < count($latest); $k++){
			$temp = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? ORDER BY seq ASC", array($boardName, $latest[$k]['no']));

			for($j = 0; $j < count($temp); $j++){
				$latest[$k]['files'][$temp[$j]['seq'] - 1] = $temp[$j];
				$latest[$k]['files'][$temp[$j]['seq'] - 1]['originalSrc'] = $fileDirectory."/".$temp[$j]['saveName'];
				$latest[$k]['files'][$temp[$j]['seq'] - 1]['thumbnailSrc'] = $fileDirectory."/thumbnail/thumbnail_".$temp[$j]['saveName'];
			}

			if($boardName == "insights_sg" || $boardName == "insights_en" || $boardName == "insights" || $boardName == "testimonials_en"){
				if($latest[$k]['files'][1]['originalSrc'] == "" && in_array($boardName, $cfg['board']['no_image'])){
					$latest[$k]['files'][1]['originalSrc'] = $cfg['baseUrl']."/images/no_image.png";
				}
			}
		}

		$qstr = getQstrCustom(array("sw"), $_GET);

		if(!$boardCoreOnly){
			include_once __DIR__."/skin.view.".$cfg['board']['skin']['view'][$boardName].".php";
		}
	// 리스트
	} else {
		$where = " isDelete = 'N' AND isSecret = 'N' ";
		$orderBy = "isNotice DESC, regDate DESC";

		$params = array();

		if($_GET['category'] != ""){
			$where .= " AND category = ? ";
			array_push($params, $_GET['category']);
		}

		if($_GET['sw'] != ""){
			switch($boardName){
				case "lesson" :
					$where .= " AND (category like ? OR subject like ?) ";
				break;
				default :
					$where .= " AND (subject like ? OR content like ?) ";
				break;
			}
			array_push($params, "%".$_GET['sw']."%");
			array_push($params, "%".$_GET['sw']."%");
		}

		if($boardName == "insights_sg" || $boardName == "insights_en" || $boardName == "insights" || $boardName == "testimonials_en"){
			// <301 Redirect + 카테고리 Static URL>
			if(!$isAsync){
				if($_GET['c'] != ""){
					foreach($cfg['board']['category'][$boardName] as $key => $value){
						if($key == $_GET['c']){
							$redirect_category_value = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $value);
							$redirect_category_value = preg_replace('/\s{2,}/', ' ', $redirect_category_value);
							$redirect_category_value = preg_replace('/ /', '-', $redirect_category_value);

							break;
						}
					}
					header("HTTP/1.1 301 Moved Permanently"); 
					header("Location: ".$cfg['href']."/insights/category/".$redirect_category_value."/"); 
					exit();
				} elseif($_GET['cpl'] != ""){
					$cpl = "";
					foreach($cfg['board']['category'][$boardName] as $key => $value){
						$value = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $value);
						$value = preg_replace('/\s{2,}/', ' ', $value);
						$value = preg_replace('/ /', '-', $value);

						if(strtolower($value) == strtolower($_GET['cpl'])){
							$cpl = $key;
							break;
						}
					}

					if($cpl != ""){
						$where .= " AND category like ? ";
						array_push($params, "%".$cpl."%");

						$_GET['c'] = $cpl;
					}
				}
			} else {
				if($_GET['c'] != ""){
					$where .= " AND category like ? ";
					array_push($params, "%".$_GET['c']."%");
				}
			}
			// </301 Redirect + 카테고리 Static URL>

			// 비동기 게시판 페이지 기억하기
			if(!$isAsync){
				// 카테고리가 다를 경우 페이지 기억 초기화
				if($_SESSION[$keep_session_name]['c'] != $_GET['c']){
					$_SESSION[$keep_session_name]['page'] = "";
				}
				$_SESSION[$keep_session_name]['c'] = $_GET['c'];
				$_SESSION[$keep_session_name]['cpl'] = $_GET['cpl'];

				// 카테고리가 다를 경우 페이지 기억 초기화
				if($_SESSION[$keep_session_name]['page'] != ""){
					$_GET['page'] = $_SESSION[$keep_session_name]['page'];
					$asyncLimit = true;
				}
			} else {
				$_SESSION[$keep_session_name]['page'] = $_GET['page'];
			}
		} else {
			$_SESSION[$keep_session_name] = "";
		}

		$dataTotal = Queryi("SELECT count(*) as Cnt FROM $tableName WHERE $where", $params);
		$dataCount = $dataTotal[0]['Cnt'];
		$fileDirectory = $cfg['boardDirectory']."/".$boardName;

		$pagingItemMax = (isset($cfg['board']['paging'][$boardName]) ? $cfg['board']['paging'][$boardName]['itemMax'] : $cfg['board']['paging']['default']['itemMax']);
		$pagingBlockMax = (isset($cfg['board']['paging'][$boardName]) ? $cfg['board']['paging'][$boardName]['blockMax'] : $cfg['board']['paging']['default']['blockMax']);

		$pageTotal  = ceil($dataCount / $pagingItemMax);

		if ($_GET['page'] == ""){ $_GET['page'] = 1; }

		$fromLimit = ($_GET['page'] - 1) * $pagingItemMax;

		if($asyncLimit){
			$rs = Queryi("SELECT * FROM $tableName WHERE $where ORDER BY $orderBy LIMIT 0, ".($pagingItemMax * $_GET['page']), $params);
		} else {
			$rs = Queryi("SELECT * FROM $tableName WHERE $where ORDER BY $orderBy LIMIT $fromLimit, ".$pagingItemMax, $params);
		}

		for($i = 0; $i < count($rs); $i++){
			if(strpos($rs[$i]['content'], "<img") !== false){
				preg_match('#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im', $rs[$i]['content'], $matches);

				$rs[$i]['innerThumb'] = $matches[2];
			}

			$temp = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? ORDER BY seq ASC", array($boardName, $rs[$i]['no']));
			for($j = 0; $j < count($temp); $j++){
				$rs[$i]['files'][$temp[$j]['seq'] - 1] = $temp[$j];
				$rs[$i]['files'][$temp[$j]['seq'] - 1]['originalSrc'] = $fileDirectory."/".$temp[$j]['saveName'];
				$rs[$i]['files'][$temp[$j]['seq'] - 1]['thumbnailSrc'] = $fileDirectory."/thumbnail/thumbnail_".$temp[$j]['saveName'];
			}

			if($rs[$i]['files'][0]['originalSrc'] == "" && in_array($boardName, $cfg['board']['no_image'])){
				$rs[$i]['files'][0]['originalSrc'] = $cfg['baseUrl']."/images/no_image.png";
			}

			if($rs[$i]['files'][1]['originalSrc'] == "" && in_array($boardName, $cfg['board']['no_image'])){
				$rs[$i]['files'][1]['originalSrc'] = $cfg['baseUrl']."/images/no_image.png";
			}

			if($rs[$i]['files'][2]['originalSrc'] == "" && in_array($boardName, $cfg['board']['no_image'])){
				$rs[$i]['files'][2]['originalSrc'] = $cfg['baseUrl']."/images/no_image.png";
			}
		}

		$qstr = getQstrCustom(array("sw"), $_GET)."&page=";

		if(!$boardCoreOnly){
			if($isAsync){
				include_once __DIR__."/skin.list.".$cfg['board']['skin']['list'][$boardName].".async.php";
			} else {
				include_once __DIR__."/skin.list.".$cfg['board']['skin']['list'][$boardName].".php";
			}
		}
	}
?>
