<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php
	define("USERNAME_INDEX", 4);
	session_start();
	if(!isset($_SESSION['UserID'])) {
		header('Location: login.php');
	}
?>

<html>
	<head>
		<title><?php echo $site_title . " - "; ?>Научи да кодираш</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/learn.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
		<script src="scripts/jquery-1.11.3.js"></script>
		<!--<script src="scripts/logoselector.js"></script>-->
		<script src="/scripts/menubuttons.js"></script>
		<script>
			$(document).ready(function() {
				$('#links, #title').hide().fadeIn(600);
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
						printf('<h6 id="welcome">Добредојдовте, <a href="#">' . $username. '</a></h6>
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
		<h1 id="title">Одберете јазик:</h1>
			<div id="links">
				<a href="#">
					<div class="pic" id="cpp">
						<img src="images/cpp-logo-200px.png" id="cppimg" />
					</div>
				</a>
				<a href="#">
					<div id="java" class="pic">
						<img src="images/java-logo-200px.png" id="javaimg" />
					</div>
				</a>
				<br />
				<a href="#">
					<div id="HTML" class="pic">
						<img src="images/html5-logo-200px.png" id="htmlimg" />
					</div>
				</a>
				<a href="#">
					<div id="JavaScript" class="pic">
						<img src="images/javascript-logo-200px.png" id="jsimg" />
					</div>
				</a>
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
