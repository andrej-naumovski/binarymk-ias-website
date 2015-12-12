<?php require 'connections.php' ?>

<?php
	if(isset($_POST['logout'])) {
		session_start();
		$userid = $_SESSION['UserID'];
		unset($_SESSION['UserID']);
		$remove = "delete from loggedin where UserID='$userid'";
		$mysqli->query($remove);
		session_destroy();
		header('Location: /index.php');
	}