<?php
	require "configPurchases.php";
	try {
		$connection = new PDO("mysql:host=$host", $username, $password,
		$options);
		$sql = file_get_contents("data/initializePurchases.sql");
		$connection->exec($sql);
		echo "Database and table 'purchases' generated and accessed successfully.";
		} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}