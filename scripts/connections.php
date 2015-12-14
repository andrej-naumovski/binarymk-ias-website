<?php
	$mysqli = new mysqli("localhost", "root", "", "binarymk_ias_website");

	$site_title ="Binary.MK";

	if($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>