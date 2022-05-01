<?php
	require "configUser.php";
	try {
		$connection = new PDO("mysql:host=$host", $username, $password,
		$options);
		$sql = file_get_contents("data/initializeUser.sql");
		$connection->exec($sql);
		echo "Database and table 'users' generated and accessed successfully.";
		} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}