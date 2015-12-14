<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php 
	define("USERNAME_INDEX", 4);
	define("FIRSTNAME_INDEX", 1);
	define("LASTNAME_INDEX", 2);
	session_start();
?>

<?php
	if(!isset($_SESSION['UserID'])) {
		header('Location: login.php');
	}
?>

<html>
	<head>
		<title><?php echo $site_title . " - "; ?>Прашање</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/question.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
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
			<a href="index.php"><img src="images/title_logo.png" /></a>
			<nav>
				<a href="index.php" id="home" class="navButton">ДОМА</a>
				<a href="learn.php" id="tuts" class="navButton">НАУЧИ ДА КОДИРАШ</a>
				<a href="practice.php" id="practice" class="navButton">ВЕЖБИ И ЗАДАЧИ</a>
				<a href="questions.php" id="questions" class="navButton">ИМАШ ПРАШАЊЕ?</a>
			</nav>
		</header>
		<div id="main">
			<div id="questionPost">
				<?php
					if(isset($_GET['id'])) {
						$question_id = $_GET['id'];
						$recover_question = "select * from questions where id='$question_id'";
						$result = $mysqli->query($recover_question);
						$row = $result->fetch_row();
						$question_title = $row[1];
						$question_content = $row[2];
						$userid = $row[3];
						$get_user = "select * from users where UserID='$userid'";
						$result = $mysqli->query($get_user);
						$user = $result->fetch_row();
						$first_name = $user[1];
						$last_name = $user[2];
						printf("<h1 id=\"questionPostTitle\">" . $question_title . "</h1>");
						printf('<br style="clear: both" />');
						printf('<br style="clear: both" />');
						printf('<h5 style="padding-left: 15px">Објавено од: ' . $first_name . ' ' . $last_name . '</h5>');
						printf('<hr>');
						printf("<p id=\"questionContent\">" . $question_content . "</p>");
						printf('<hr>');
					}
				?>
			</div>
			<div id="answers">
				<h2>ОДГОВОРИ:</h2>
				<?php
					$question_id = $_GET['id'];
					$fetch_results = "select * from answers where QuestionID='$question_id'";
					$result = $mysqli->query($fetch_results);
					while($row = $result->fetch_row()) {
						$post_answerer = $row[3];
						$get_user_answer = "select * from users where UserID='$post_answerer'";
						$res = $mysqli->query($get_user_answer);
						$answerer = $res->fetch_row();
						$ans_first_name = $answerer[1];
						$ans_last_name = $answerer[2];
						$answer = wordwrap($row[1], 100, "<br />\n", true);
						printf('<h3 style="padding-left: 15px">' . $ans_first_name . ' ' . $ans_last_name . '</h3>');
						printf("<p id=\"answerContent\">" . $answer . "</p>");
						printf('<hr>');
					}
				?>
			</div>
			<div id="postAnswer">
				<form method="post" id="newAnswer" action="">
					<textarea name="answer" id="answer" rows="15" cols="100" placeholder="Вашиот одговор овде" required></textarea>
					<br style="clear: both" />
					<button type="submit" name="submit">ОДГОВОРИ</button>
					<?php
						if(isset($_POST['submit'])) {
							$answererid = $_SESSION['UserID'];
							$answer_content = $_POST['answer'];
							$question_id = $_GET['id'];
							$add_answer = "insert into answers (Content,QuestionID,UserID)Values('$answer_content','$question_id','$answererid')";
							$mysqli->query($add_answer);
							header('Refresh: 0');
						}
					?>
				</form>
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