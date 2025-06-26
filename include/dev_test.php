<?
	include_once __DIR__."/core/common.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/include/core/PHPMailer/PHPMailerAutoload.php";

    echo 1;
exit;

	$mail_msg = "테스트";

	sendMailToAdmin("테스트 제목", $mail_msg);
?>