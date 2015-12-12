<?php require 'connections.php'; ?>

<?php
	if(isset($_POST['submitPost'])) {
		session_start();
		$title = $mysqli->real_escape_string($_POST['postTitle']);
		$content = $mysqli->real_escape_string($_POST['postContent']);
		$post_userid = $_SESSION['UserID'];
		$insert_post = "insert into blogposts (PostTitle, PostContent, UserID)Values('$title','$content','$post_userid')";
		$mysqli->query($insert_post);
		header('Location: /index.php');
	}
?>