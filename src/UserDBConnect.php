<?php
	require_once '../configUser.php';
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		echo 'Connected to User Database';
		} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}
?>