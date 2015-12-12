<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php 
	define("USERNAME_INDEX", 4);
	define("FIRSTNAME_INDEX", 1);
	define("LASTNAME_INDEX", 2);
	session_start();
?>

<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/blog.css" rel="stylesheet" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
		<script src="/scripts/jquery-1.11.3.js"></script>
		<script src="/scripts/menubuttons.js"></script>
		<script>
			$(document).ready(function() {
				$('#blogPost').hide().fadeIn(600);
			});
		</script>
	</head>
	<body>
		<header>
			<div id="userbar">
				<?php
					if(isset($_SESSION['UserID'])) {
						$userid = $_SESSION['UserID'];
						$sql = "select * from users where UserID='$userid'";
						$result = $mysqli->query($sql);
						$row = $result->fetch_row();
						$username = $row[USERNAME_INDEX];
						printf('<h6 id="welcome">Добредојдовте, <a href="#">' . $username . '</a></h6>
								<form method="post" action="scripts/logout.php"><input id="logout" type="submit" name="logout" value="Одјави се" /></form>');
					} else {
						printf('<h6 id="welcome">Не сте најавени</a></h6>
								<h6 id="login"><a href="login.php">Најави се</a></h6>');
					}
				?>
			</div>
			<br style="clear:both;"/>
			<img src="images/title_logo.png" />
			<nav>
				<a href="index.php" id="home" class="navButton">ДОМА</a>
				<a href="learn.php" id="tuts" class="navButton">НАУЧИ ДА КОДИРАШ</a>
				<a href="practice.php" id="practice" class="navButton">ВЕЖБИ И ЗАДАЧИ</a>
				<a href="questions.php" id="questions" class="navButton">ИМАШ ПРАШАЊЕ?</a>
			</nav>
		</header>
		<div id="main">
			<div id="blogPost">
				<?php
					if(isset($_GET['title'])) {
						$post_title = $_GET['title'];
						$recover = "select * from blogposts where PostTitle='$post_title'";
						$result = $mysqli->query($recover);
						$row = $result->fetch_row();
						$post_content = wordwrap("" . $row[2], 100, "<br />\n", true);
						$userid = $row[4];
						$recover = "select * from users where UserID='$userid'";
						$user_result = $mysqli->query($recover);
						$user_row = $user_result->fetch_row();
						$first_name = $user_row[FIRSTNAME_INDEX];
						$last_name = $user_row[LASTNAME_INDEX];
						printf("<h1 id=\"blogPostTitle\">" . $post_title . "</h1>");
						printf('<br style="clear: both" />');
						printf('<h5 style="padding-left: 15px">Објавено од: ' . $first_name . ' ' . $last_name . '</h5>');
						printf('<hr>');
						printf("<p id=\"blogPostContent\">" . $post_content . "</p>");
					}
				?>
			</div>
		</div>
		<img src="images/register-undershade.png" style="margin: auto; width: 960px;" />
		<footer>
			<p id="copyright">COPYRIGHT &copy; BINARY.MK, 2015. РАЗВИЕНО ОД АНДРЕЈ НАУМОВСКИ И ЃОРЃИ МАРКОВ. СИТЕ ПРАВА СЕ ЗАДРЖАНИ</p>
			<p id="contact"><a href="contact.php">КОНТАКТ</a></p>
			<img src="images/register-undershade.png" />
		</footer>
	</body>
</html>