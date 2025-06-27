<?php
	include_once "../../../core/common.php";
	adminCheck();

	$tableName = $cfg['db']['prefix']."online_application";
	$fileDirectory = $cfg['dir']['online_application'];

	$lang = "kr";
	$country = $_GET['country'];

	if($_GET['mode'] == "update"){
		$rs = Queryi("SELECT * FROM $tableName WHERE no = ?", array($_GET['no']), true);

		$fileDirectory .= "/".$rs['client_code'];

		if(strpos($rs['activities'], "^^") !== false){
			$tmp = explode("^^", $rs['activities']);
			for($k = 0; $k < count($tmp); $k++){
				$tmp[$k] = $cfg['application']['activities'][$lang][$country][$tmp[$k]];
			}
			$rs['activities'] = implode("\r\n", $tmp);
		} elseif($rs['activities'] != ""){
			$rs['activities'] = $cfg['application']['activities'][$lang][$country][$rs['activities']];
		}

		$rs['major_phone'] = explode("^^", $rs['major_phone']);

		// 이사
		$rs['ceo_name'] = explode("^^", $rs['ceo_name']);
		$rs['ceo_phone'] = explode("^^", $rs['ceo_phone']);
		$rs['ceo_email'] = explode("^^", $rs['ceo_email']);

		// 주주
		$rs['shareholder_pb'] = explode("^^", $rs['shareholder_pb']);
		$rs['shareholder_name'] = explode("^^", $rs['shareholder_name']);
		$rs['shareholder_phone'] = explode("^^", $rs['shareholder_phone']);
		$rs['shareholder_email'] = explode("^^", $rs['shareholder_email']);
		$rs['shareholder_equity'] = explode("^^", $rs['shareholder_equity']);

		$upload_prefixes = array(
			"ceo_passport",
			"ceo_residentcard",
			"shareholder_passport",
			"shareholder_residentcard",
			"shareholder_businesslicense",
			"shareholder_list",
			"shareholder_representative_passport",
		);

		foreach($upload_prefixes as $key){
			$rs[$key."_files"] = files_string_to_explode($rs[$key."_upload"]);
		}
	} else {
		// $dataCount = Queryi("SELECT MAX(seq) as latestSeq FROM $tableName WHERE is_delete = 'N'", array(), true);
		// $rs['seq'] = $dataCount['latestSeq'] + 1;
		$rs['regdate'] = date("Y-m-d H:i:s");
	}

	$qstr = getQstrCustom(array("country"), $_GET)."&page=".$_GET['page'];

	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_header.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_navi.php";
?>
<script>
	$(function(){
		$("#form").bind("submit", function(){
			if($(this).find("[name='title']").val() == ""){
				alert("관리용 제목을 입력해주세요.");
				$(this).find("[name='title']").focus();
				return false;
			}
		});
	});
</script>
<?
	if($country != "korea"){
		include_once __DIR__."/edit.skin.singapore.php";
	} else {
		include_once __DIR__."/edit.skin.korea.php";
	}
?>
<? include_once __DIR__."/edit.save_inner_html.php";?>
<? include_once $cfg['root'].$cfg['dir']['admin']."/views/common_footer.php"; ?>