<?php
	if(isset($_POST['logout'])) {
		session_start();
		unset($_SESSION['UserID']);
		session_destroy();
		header('Location: /index.php');
	}