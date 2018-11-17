<?php
	require_once('response.php');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'postgres');
	DEFINE('DB_USER', 'postgres');
	DEFINE('DB_PASSWORD', 'postgres');
	try {
		$pdo = new PDO('pgsql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
