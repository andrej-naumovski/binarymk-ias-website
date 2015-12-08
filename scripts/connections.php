<?php
	$mysqli = new mysqli("localhost", "root", "", "binarymk_ias_website");

	if($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>