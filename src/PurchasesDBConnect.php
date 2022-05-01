<?php
	require_once '../configPurchases.php';
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		echo 'Connected to Purchases Database';
		} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}
?>