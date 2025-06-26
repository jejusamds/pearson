<?php
	try {
		$mysqli = new PDO("mysql:host=".$cfg['db']['host'].";dbname=".$cfg['db']['name'], $cfg['db']['-u'], $cfg['db']['-p']);
	} catch(PDOException $e) {
		print_r('Connection failed: ' . $e->getMessage());
	}

	$mysqli->exec("set names utf8");
	$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
