<? 
	include '../../../core/common.php';
	include_once "../../../core/PHP_XLSXWriter/xlsxwriter.class.php";

	adminCheck();

	$tableName = $cfg['db']['prefix']."online_application";
	$pdfTableName = $cfg['db']['prefix']."online_application_pdf_content";
	$lang = "kr";
	$country = $_GET['country'];

	// 첨부파일 데이터 불러오기
	$data = Queryi("SELECT * FROM $tableName WHERE no = ?", array($_GET['no']), true);

	$fileDirectory = $cfg['root'].$cfg['dir']['online_application']."/".$data['client_code'];

	if(strpos($data['activities'], "^^") !== false){
		$tmp = explode("^^", $data['activities']);
		for($k = 0; $k < count($tmp); $k++){
			$tmp[$k] = $cfg['application']['activities'][$lang][$country][$tmp[$k]];
		}
		$data['activities'] = implode("\r\n", $tmp);
	} elseif($data['activities'] != ""){
		$data['activities'] = $cfg['application']['activities'][$lang][$country][$data['activities']];
	}

	$data['major_phone'] = explode("^^", $data['major_phone']);

	// 이사
	$data['ceo_name'] = explode("^^", $data['ceo_name']);
	$data['ceo_phone'] = explode("^^", $data['ceo_phone']);
	$data['ceo_email'] = explode("^^", $data['ceo_email']);

	// 주주
	$data['shareholder_pb'] = explode("^^", $data['shareholder_pb']);
	$data['shareholder_name'] = explode("^^", $data['shareholder_name']);
	$data['shareholder_phone'] = explode("^^", $data['shareholder_phone']);
	$data['shareholder_email'] = explode("^^", $data['shareholder_email']);
	$data['shareholder_equity'] = explode("^^", $data['shareholder_equity']);

	$upload_prefixes = array(
		"ceo_passport",
		"ceo_residentcard",
		"shareholder_passport",
		"shareholder_residentcard",
		"shareholder_businesslicense",
		"shareholder_list",
		"shareholder_representative_passport",
	);

	$compress_files = array();
	$remove_files = array();
	
	// 첨부파일 존재 여부 확인
	$isSetAttachedFile = false;

	$k = 1;
	foreach($upload_prefixes as $key){
		$data[$key."_files"] = files_string_to_explode($data[$key."_upload"]);

		for($i = 0; $i < count($data[$key."_files"]); $i++){
			if($data[$key.'_files'][$i]['save_name'] != "" && file_exists($fileDirectory."/".$data[$key.'_files'][$i]['save_name'])){
				$uniq = uniqid();

				if(!copy($fileDirectory."/".$data[$key.'_files'][$i]['save_name'], './record/'.$uniq."_".$data[$key.'_files'][$i]['save_name'])){
					alert('파일 압축에 실패하였습니다.\n지속적인 문제발생 시 관리자에게 문의바랍니다.');
				} else {
//					$compress_files[] = array(
//						PCLZIP_ATT_FILE_NAME => urlencode("./record/".$uniq."_".$data[$key.'_files'][$i]['save_name']),
//						PCLZIP_ATT_FILE_NEW_FULL_NAME => urlencode("./record/".$data[$key.'_files'][$i]['real_name']),
//						PCLZIP_ATT_FILE_NAME => "./record/".$uniq."_".$data[$key.'_files'][$i]['save_name'],
//						PCLZIP_ATT_FILE_NEW_FULL_NAME => "./record/".$data[$key.'_files'][$i]['real_name'],
//						PCLZIP_ATT_FILE_NAME => iconv("utf-8", "cp949", "./record/".$uniq."_".$data[$key.'_files'][$i]['save_name']),
//						PCLZIP_ATT_FILE_NEW_FULL_NAME => iconv("utf-8", "cp949", "./record/".$data[$key.'_files'][$i]['real_name']),
//						PCLZIP_ATT_FILE_NAME => iconv("euc-kr", "utf-8", "./record/".$uniq."_".$data[$key.'_files'][$i]['save_name']),
//						PCLZIP_ATT_FILE_NEW_FULL_NAME => iconv("euc-kr", "utf-8", "./record/".$data[$key.'_files'][$i]['real_name']),
//					);

					$compress_files[] = array("save_name" => "./record/".$uniq."_".$data[$key.'_files'][$i]['save_name'], "real_name" => $k."_".$data[$key.'_files'][$i]['real_name']);

					$remove_files[] = "./record/".$uniq."_".$data[$key.'_files'][$i]['save_name'];

					$k++;
				}
			}
		}
	}

/*
	// 폴더째 첨부
	if($isSetAttachedFile){
		$compress_files[] = $fileDirectory;
	}
*/

	$excelData = array();

	// 엑셀 생성
	if($country != "korea"){
		$columnWidth = array(70, 150);
		// singapore Skin
		if(isset($cfg['application']['skin'][$lang][$country]['corporate_form'])){
			// 법인 형태
			$tmp = array();
			foreach($cfg['application']['skin'][$lang][$country]['corporate_form'] as $key => $arr){
				if($arr['value'] == $data['corporate_form']){
					$tmp[] = $arr['text'];
				}
			}
			if(count($tmp) > 0){
				$excelData[] = array(
					"label" => "법인 형태 (Type of entity)",	
					"value" => implode(", ", $tmp),
				);
			}
			unset($tmp);
		}
		// 법인명
		$excelData[] = array(
			"label" => "법인명 (company name)",
			"value" => $data['company_name'],
		);
		// 영업활동
		$excelData[] = array(
			"label" => "영업활동 (business activity)",
			"value" => $data['activities'],
		);
		// 법인 주소지
		$excelData[] = array(
			"label" => "법인 주소지 (business address)",
			"value" => (($data['acting_address'] == "self") ? '직접입력 (Self)' : '피어슨 주소지 대행 (Provided by pearson)').(($data['acting_address_text'] != "") ? " (".$data['acting_address_text'].")" : ''),
		);
		// 자본금
		$excelData[] = array(
			"label" => "자본금 (paid in capital)",
			"value" => $data['capital_amount'],
		);
		// 주요 연락망 이름/전화번호/이메일
		$excelData[] = array(
			"label" => "주요 연락망 이름 (main contactor)",
			"value" => $data['major_phone'][0],
		);
		$excelData[] = array(
			"label" => "주요 연락망 전화번호 (main contactor phone number)",
			"value" => $data['major_phone'][1],
		);
		$excelData[] = array(
			"label" => "주요 연락망 이메일 (main contactor email)",
			"value" => $data['major_phone'][2],
		);
		// 현지대리이사가 필요하신가요?
		if($cfg['application']['skin'][$lang][$country]['acting_local_agent']){
			$excelData[] = array(
				"label" => "현지대리이사가 필요하신가요? (do you need a nominee director?)",
				"value" => (($data['acting_local_agent'] == 'Y') ? '예, 피어슨파트너스 대리이사 서비스를 이용합니다. (Yes, need a nominee director)' : '아니오 (No)'),
			);
		}
		// 이사
		for($i = 0; $i < count($data['ceo_name']); $i++){
			$excelData[] = array(
				"label" => "이사 ".($i + 1)." - 이름 (영문) (director ".($i + 1)." - name)",
				"value" => $data['ceo_name'][$i],
			);
			$excelData[] = array(
				"label" => "이사 ".($i + 1)." - 전화번호 (director ".($i + 1)." - phone number)",
				"value" => $data['ceo_phone'][$i],
			);
			$excelData[] = array(
				"label" => "이사 ".($i + 1)." - 이메일 (director ".($i + 1)." - email)",
				"value" => $data['ceo_email'][$i],
			);
			$excelData[] = array(
				"label" => "이사 ".($i + 1)." - 여권사본 (director ".($i + 1)." - copy of passport)",
				"value" => (($data['ceo_passport_files'][$i]['save_name'] != "") ? $data['ceo_passport_files'][$i]['real_name'] : ''),
			);
			$excelData[] = array(
				"label" => "이사 ".($i + 1)." - 영문주민등록등본 (director ".($i + 1)." - household register)",
				"value" => (($data['ceo_residentcard_files'][$i]['save_name'] != "") ? $data['ceo_residentcard_files'][$i]['real_name'] : ''),
			);
		}
		// 주주
		for($i = 0; $i < count($data['shareholder_name']); $i++){
			$excelData[] = array(
				"label" => "주주 ".($i + 1)." - 개인/법인 (shareholder ".($i + 1)." type - individual/entity)",
				"value" => (($data['shareholder_pb'][$i] == "privacy") ? '개인 (individual)' : '법인 (entity)'),
			);
			$excelData[] = array(
				"label" => "주주 ".($i + 1)." - 이름 (영문) (shareholder ".($i + 1)." type - name)",
				"value" => $data['shareholder_name'][$i],
			);
			$excelData[] = array(
				"label" => "주주 ".($i + 1)." - 전화번호 (shareholder ".($i + 1)." type - phone number)",
				"value" => $data['shareholder_phone'][$i],
			);
			$excelData[] = array(
				"label" => "주주 ".($i + 1)." - 이메일 (shareholder ".($i + 1)." type - email)",
				"value" => $data['shareholder_email'][$i],
			);
			$excelData[] = array(
				"label" => "주주 ".($i + 1)." - 지분 (shareholder ".($i + 1)." type - percentage of shares)",
				"value" => $data['shareholder_equity'][$i],
			);

			if($data['shareholder_pb'][$i] == "privacy"){
				$excelData[] = array(
					"label" => "주주 ".($i + 1)." - 여권사본 (shareholder ".($i + 1)." type - copy of passport)",
					"value" => (($data['shareholder_passport_files'][$i]['save_name'] != "") ? $data['shareholder_passport_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => "주주 ".($i + 1)." - 영문주민등록등본 (shareholder ".($i + 1)." type - household register)",
					"value" => (($data['shareholder_residentcard_files'][$i]['save_name'] != "") ? $data['shareholder_residentcard_files'][$i]['real_name'] : ''),
				);
			} else {
				$excelData[] = array(
					"label" => "주주 ".($i + 1)." - 영문사업자등록증 (shareholder ".($i + 1)." type - Provided by pearson)",
					"value" => (($data['shareholder_businesslicense_files'][$i]['save_name'] != "") ? $data['shareholder_businesslicense_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => "주주 ".($i + 1)." - 영문주주명부 (shareholder ".($i + 1)." type - Registrar of shareholders)",
					"value" => (($data['shareholder_list_files'][$i]['save_name'] != "") ? $data['shareholder_list_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => "주주 ".($i + 1)." - 법인대표자 여권사본 (shareholder ".($i + 1)." type - Passport copy of representative)",
					"value" => (($data['shareholder_representative_passport_files'][$i]['save_name'] != "") ? $data['shareholder_representative_passport_files'][$i]['real_name'] : ''),
				);
			}
		}
	} else {
		$columnWidth = array(40, 150);
		// korea Skin
		if(isset($cfg['application']['skin'][$lang][$country]['corporate_form'])){
			// 법인 형태
			$tmp = array();
			foreach($cfg['application']['skin'][$lang][$country]['corporate_form'] as $key => $arr){
				if($arr['value'] == $data['corporate_form']){
					$tmp[] = $arr['text'];
				}
			}
			if(count($tmp) > 0){
				$excelData[] = array(
					"label" => "Business Type",	
					"value" => implode(", ", $tmp),
				);
			}
			unset($tmp);
		}
		// 법인명
		$excelData[] = array(
			"label" => "Company Name",
			"value" => $data['company_name'],
		);
		// 영업활동
		$excelData[] = array(
			"label" => "Business Activity",
			"value" => $data['activities'],
		);
		// 법인 주소지
		$excelData[] = array(
			"label" => "Registered Address",
			"value" => (($data['acting_address'] == "self") ? 'I have my own office address in Korea' : 'Use Pearson’s address service').(($data['acting_address_text'] != "") ? " (".$data['acting_address_text'].")" : ''),
		);
		// 자본금
		if($data['capital_amount'] != ""){
			$excelData[] = array(
				"label" => "Paid-up Capital",
				"value" => $data['capital_amount'],
			);
		}
		// 주요 연락망 이름/전화번호/이메일
		$excelData[] = array(
			"label" => "Main Contact Name",
			"value" => $data['major_phone'][0],
		);
		$excelData[] = array(
			"label" => "Main Contact Phone Number",
			"value" => $data['major_phone'][1],
		);
		$excelData[] = array(
			"label" => "Main Contact Email",
			"value" => $data['major_phone'][2],
		);
		// 현지대리이사가 필요하신가요?
		if($cfg['application']['skin'][$lang][$country]['acting_local_agent']){
			$excelData[] = array(
				"label" => "현지대리이사가 필요하신가요?",
				"value" => (($data['acting_local_agent'] == 'Y') ? '예, 피어슨파트너스 대리이사 서비스를 이용합니다.' : '아니오'),
			);
		}
		// 이사
		for($i = 0; $i < count($data['ceo_name']); $i++){
			if($data['corporate_form'] != "Branch" && $data['corporate_form'] != "Liaison"){
				$frontLabel = "Representative ".($i + 1);
			} else {
				$frontLabel = "Representative";
			}
			$excelData[] = array(
				"label" => $frontLabel." - Name",
				"value" => $data['ceo_name'][$i],
			);
			$excelData[] = array(
				"label" => $frontLabel." - Phone Number",
				"value" => $data['ceo_phone'][$i],
			);
			$excelData[] = array(
				"label" => $frontLabel." - Email",
				"value" => $data['ceo_email'][$i],
			);
			$excelData[] = array(
				"label" => $frontLabel." - Copy of Passport",
				"value" => (($data['ceo_passport_files'][$i]['save_name'] != "") ? $data['ceo_passport_files'][$i]['real_name'] : ''),
			);
			$excelData[] = array(
				"label" => $frontLabel." - Proof of Residential Address",
				"value" => (($data['ceo_residentcard_files'][$i]['save_name'] != "") ? $data['ceo_residentcard_files'][$i]['real_name'] : ''),
			);
		}
		// 주주
		for($i = 0; $i < count($data['shareholder_name']); $i++){
			if($data['corporate_form'] != "Branch" && $data['corporate_form'] != "Liaison"){
				$frontLabel = "Shareholder ".($i + 1);
			} else {
				$frontLabel = "Parent Company";
			}

			$excelData[] = array(
				"label" => $frontLabel." - Individual/Corporate",
				"value" => (($data['shareholder_pb'][$i] == "privacy") ? 'Individual' : 'Corporate'),
			);
			$excelData[] = array(
				"label" => $frontLabel." - Name",
				"value" => $data['shareholder_name'][$i],
			);
			$excelData[] = array(
				"label" => $frontLabel." - Phone Number",
				"value" => $data['shareholder_phone'][$i],
			);
			$excelData[] = array(
				"label" => $frontLabel." - Email",
				"value" => $data['shareholder_email'][$i],
			);
			if($data['corporate_form'] != "Branch" && $data['corporate_form'] != "Liaison"){
				$excelData[] = array(
					"label" => $frontLabel." - Shareholding %",
					"value" => $data['shareholder_equity'][$i],
				);
			}

			if($data['shareholder_pb'][$i] == "privacy"){
				$excelData[] = array(
					"label" => $frontLabel." - Copy of Passport",
					"value" => (($data['shareholder_passport_files'][$i]['save_name'] != "") ? $data['shareholder_passport_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => $frontLabel." - Proof of Residential Address",
					"value" => (($data['shareholder_residentcard_files'][$i]['save_name'] != "") ? $data['shareholder_residentcard_files'][$i]['real_name'] : ''),
				);
			} else {
				$excelData[] = array(
					"label" => $frontLabel." - Certificate of Business Registration",
					"value" => (($data['shareholder_businesslicense_files'][$i]['save_name'] != "") ? $data['shareholder_businesslicense_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => $frontLabel." - Registrar of Shareholders",
					"value" => (($data['shareholder_list_files'][$i]['save_name'] != "") ? $data['shareholder_list_files'][$i]['real_name'] : ''),
				);
				$excelData[] = array(
					"label" => $frontLabel." - Copy of Passport (Parent Company Representative)",
					"value" => (($data['shareholder_representative_passport_files'][$i]['save_name'] != "") ? $data['shareholder_representative_passport_files'][$i]['real_name'] : ''),
				);
			}
		}
	}
	


	// 엑셀파일 생성
	if(count($excelData) > 0){
		$excelFilename = iconv("utf-8", "cp949", "application_contents_".date("YmdHis")).".xlsx";
		$excelFiledir = "record/".$excelFilename;

		$writer = new XLSXWriter();

		$header = array(
"Column Name" => "@",
"Values" => "@",
		);

		$writer->writeSheetHeader("Application Data", $header, $col_options = array('halign' => "center", 'widths'=>$columnWidth));

		foreach($excelData as $key => $value){
			$row = array(
				$value['label'],
				$value['value'],
			);

			$row_options = array(
				array('wrap_text'=>true, 'valign'=>'center', 'halign'=>'left'),
				array('wrap_text'=>true, 'valign'=>'center', 'halign'=>'left'),
			);

			$writer->writeSheetRow("Application Data", $row, $row_options);
		}

		$writer->writeToFile($excelFiledir);

		$compress_files[] = array(
			"save_name" => $excelFiledir,
			"real_name" => "application_contents.xlsx",
		);
	}

	// zip 파일 압축
	if(count($compress_files) > 0){
		$zipfile_name = 'online_application_'.$data['client_code'].'_'.date("YmdHis").'.zip';
		$zipfile_src = 'record/'.$zipfile_name;
		/*
		$zipfile_name = 'online_application_'.$data['client_code'].'_'.date("YmdHis").'.7z';
		$zipfile_src = 'record/'.$zipfile_name;
//		$zipfile_src = $fileDirectory.'/'.$zipfile_name;
		$zipfile = new PclZip($zipfile_src); 

		$create_zipfile = $zipfile->create($compress_files, PCLZIP_OPT_REMOVE_ALL_PATH);
*/
		$zipfile = new ZipArchive();
		if ($zipfile->open($zipfile_src, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$filename>\n");
		}
//		$zip->addFile($_FILES["data"]["tmp_name"],$_FILES["data"]["name"]);

		for($i = 0; $i < count($compress_files); $i++){
			$zipfile->addFile($compress_files[$i]['save_name'], $compress_files[$i]['real_name']);
		}
		$zipfile->close();

		// 파일다운로드
		ob_start();
		 
		$filedir = $zipfile_src;
		$filename = iconv("utf-8", "cp949", $zipfile_name);
		 
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

			// 생성한 zip 파일 삭제
			if($zipfile_src){
				@unlink($zipfile_src);
			}

			// 생성한 엑셀 파일 삭제
			if($excelFiledir){
				@unlink($excelFiledir);
			}

			// 복사한 파일 삭제
			if(count($remove_files) > 0){
				foreach($remove_files as $key => $value){
					@unlink($value);
				}
			}

			} else {
			alert("해당 파일이나 경로가 존재하지 않습니다.");
			}
		} else {
			// 복사한 파일 삭제
			if(count($remove_files) > 0){
				foreach($remove_files as $key => $value){
					@unlink($value);
				}
			}

			alert("파일을 찾을 수 없습니다.");
		}
	} else {
		alert("압축할 파일이 존재하지 않습니다.\n지속적인 문제발생 시 관리자에게 문의바랍니다.");
	}
?>