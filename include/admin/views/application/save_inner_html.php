<?
	include '../../../core/common.php';
	adminCheck();

	$tableName = $cfg['db']['prefix']."online_application_pdf_content";

	switch($_POST['mode']){
		case "save" : 
			$pno = $_POST['parent_v'];

			if($pno){
				$isAlready = Queryi("SELECT * FROM ".$cfg['db']['prefix']."online_application_pdf_content WHERE pno = ?", array($pno), true);

				if(!$isAlready){
					Queryi("INSERT $tableName SET pno = ?, inner_html = ?, regip = ?, regdate = NOW()", array($pno, $_POST['inner_html'], getIP()));
				}
			}
		break;
	}
?>