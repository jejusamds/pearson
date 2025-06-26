<?php
	include_once '../core/common.php';

	if(isset($_POST['username'])){
		$login = loginSession($cfg['db']['prefix'].'admin', $_POST['username'], $_POST['password']);	
		if($login){
			header("Location: views/dashboard.php");
		} else {
			echo '<script>alert("아이디 혹은 비밀번호가 일치하지 않습니다."); location.href="./index.php";</script>';
		}
	}

	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_header.php";
	include_once "views/login_view.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_footer.php";
?>