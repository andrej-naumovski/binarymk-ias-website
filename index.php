<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php
	session_start();
	if(!isset($_SESSION['UserID'])) {
		header('Location: login.php');
	} else {
		echo 'Hello!';
	}
?>

<html>
	<body>
		<form method="post" action=''>
			<input type="submit" name="logout" value="Logout" />
			<?php
				if(isset($_POST['logout'])) {
					unset($_SESSION['UserID']);
					session_destroy();
					header('Location: login.php');
				}
			?>
		</form>
	</body>
</html>