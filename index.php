<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php 
	define("USERNAME_INDEX", 4);
	session_start();
?>

<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/home.css" rel="stylesheet" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
		<script src="/scripts/jquery-1.11.3.js"></script>
		<script src="/scripts/menubuttons.js"></script>
		<script>
			$(document).ready(function() {
				$('#blog, #mostRecent').hide().fadeIn(600);
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
			<div id="blog">
				<h1>БЛОГ ОБЈАВИ</h1>
				<?php
					define("LEVEL_ADMIN", 9);

					if(isset($_SESSION['UserID'])) {
						if($_SESSION['UserID'] == LEVEL_ADMIN) {
							printf('<h5 id="newPost"><a href="newpost.php">Нова објава</a></h5>');
						}
					}
				?>
				<?php
					$recover_posts = "select * from blogposts order by PostID desc limit 5";
					$result = $mysqli->query($recover_posts);
					for($i=0; $i < 5 && $row = $result->fetch_row(); $i++) {
						$title = $row[1];
						$content = wordwrap($row[2], 60, "<br />\n", true);
						if(strlen($content) > 300) {
							$short_content = substr($content, 0, 300) . "...";
						} else {
							$short_content = $content;
						}
						printf('<div class="blogElement">');
						printf('<div class="image"><img src="images/test_main.png" /></div>');
						printf('<div class="text">');
						printf('<form class="blogpost" method="get" action="blog.php"><input type="submit" name="title" id="title" value="' . $title . '" /></form>');
						printf('<p>' . $short_content . '</p>');
						printf('</div>');
						printf("</div>");
						printf('<br style="clear:both;"/>');
					}
				?>
				<!--<div class="blogElement">
					<div class="image"><img src="images/test_main.png" /></div>
					<div class="text">
						<h2>ОБЈАВА 1</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Aliquam molestie odio ut massa vehicula viverra.
							Nulla a enim massa. Proin semper,
							neque vitae laoreet volutpat, dolor elit dapibus urna,
							id pulvinar lectus dui vitae ligula. Aliquam sed porta diam.
							Cum sociis natoque penatibus et...</p>
					</div>
				</div>
				<br style="clear:both;"/>
				<div class="blogElement">
					<div class="image"><img src="images/test_main.png" /></div>
					<div class="text">
						<h2>ОБЈАВА 1</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Aliquam molestie odio ut massa vehicula viverra.
							Nulla a enim massa. Proin semper,
							neque vitae laoreet volutpat, dolor elit dapibus urna,
							id pulvinar lectus dui vitae ligula. Aliquam sed porta diam.
							Cum sociis natoque penatibus et...</p>
					</div>
				</div> -->
			</div>
			<div id="mostRecent">
				<table id="mostRecentLinks">
					<tbody>
						<tr>
							<th>НАЈНОВИ ПРАШАЊА</th>
						</tr>
						<tr>
							<td>
								<ul>
									<?php
										$get = 'select * from questions order by id desc limit 3';
										$result = $mysqli->query($get);
										while($row = $result->fetch_row()) {
											$questionid = $row[0];
											$title = $row[1];
											printf('<li>' . '<form class="question" method="get" action="question.php">
												<button type="submit" id="questionTitle" name="id" value="' . $questionid . '"><h1>' . $title . '</h1></button></form>' . '</li>');
										}
									?>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br style="clear:both;"/>
		</div>
		<img src="images/register-undershade.png" style="margin: auto; width: 960px;" />
		<footer>
			<p id="copyright">COPYRIGHT &copy; BINARY.MK, 2015. РАЗВИЕНО ОД АНДРЕЈ НАУМОВСКИ И ЃОРЃИ МАРКОВ. СИТЕ ПРАВА СЕ ЗАДРЖАНИ</p>
			<p id="contact"><a href="contact.php">КОНТАКТ</a></p>
			<img src="images/register-undershade.png" />
		</footer>
	</body>
</html>