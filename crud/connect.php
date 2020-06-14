<?php
	$port = 3306;
	$database = "temp";
	$pass = 'root';
	$user = 'root';
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname='.$database, $pass,$user);

	//DIes when an error occours
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
