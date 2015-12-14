<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php 
	define("USERNAME_INDEX", 4);
	define("QUESTIONTITLE_INDEX", 1);
	define("QUESTIONS_USERID_INDEX", 3);
	session_start();
	if(!isset($_SESSION['UserID'])) {
		header('Location: login.php');
	}
?>

<html>
	<head>
		<title><?php echo $site_title . " - "; ?>Прашања</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/questions.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
		<script src="/scripts/jquery-1.11.3.js"></script>
		<script src="/scripts/menubuttons.js"></script>
		<script>
			$(document).ready(function() {
				$('#hide').hide().fadeIn(600);
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
			<a href="index.php"><img src="images/title_logo.png" /></a>
			<nav>
				<a href="index.php" id="home" class="navButton">ДОМА</a>
				<a href="learn.php" id="tuts" class="navButton">НАУЧИ ДА КОДИРАШ</a>
				<a href="practice.php" id="practice" class="navButton">ВЕЖБИ И ЗАДАЧИ</a>
				<a href="questions.php" id="questions" class="navButton">ИМАШ ПРАШАЊЕ?</a>
			</nav>
		</header>
		<div id="main">
			<div id="hide">
				<div id="top">
					<h3 id="ask"><a href="askquestion.php">ПОСТАВИ ПРАШАЊЕ</a></h3>
					<br style="clear: both;"/>
					<br style="clear: both;"/>
					<h1 id="title">НАЈНОВИ ПРАШАЊА</h1>
					<br style="clear: both;"/>
				</div>
				<?php
					$get_questions = "select * from questions order by id desc";
					$result = $mysqli->query($get_questions);
					while($row = $result->fetch_row()) {
						$title = $row[1];
						$userid = $row[QUESTIONS_USERID_INDEX];
						$questionid = $row[0];
						$get_username = "select * from users where UserID='$userid'";
						$user = $mysqli->query($get_username);
						$user_row = $user->fetch_row();
						$username = $user_row[USERNAME_INDEX];
						printf('<div id="question">');
						printf('<form class="question" method="get" action="question.php"><button type="submit" id="questionTitle" name="id" value="' . $questionid . '"><h1>' . $title . '</h1></button></form>');
						printf('<br style="clear: both;"');
						printf('<h4>&nbsp; &nbsp; &nbsp; &nbsp;Поставено од: ' . $username);
						printf('</div>');
						printf('<br style="clear: both" />');
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