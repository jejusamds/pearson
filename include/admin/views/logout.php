<?php
	include_once '../../core/common.php';

	session_destroy();

	redirectUrl($cfg['dir']['admin']."/index.php");
?>