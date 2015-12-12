<?php require 'connections.php'; ?>

<?php
	if(isset($_POST['submitQuestion'])) {
		session_start();
		$title = $mysqli->real_escape_string($_POST['questionTitle']);
		$content = $mysqli->real_escape_string($_POST['questionContent']);
		$post_userid = $_SESSION['UserID'];
		$insert_post = "insert into questions (Title, Content, UserID)Values('$title','$content','$post_userid')";
		$mysqli->query($insert_post);
		header('Location: /index.php');
	}
?>