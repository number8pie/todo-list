<?php

try {
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";", DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}
/*
	try {
		$results = $db->query("SELECT * FROM list_data");
	} catch (Exception $e) {
		echo "Could not retrieve data from database.";
		exit;
	}

	echo "<pre>";
	$info = $results->fetchAll(PDO::FETCH_ASSOC);
	echo "</pre>";
*/