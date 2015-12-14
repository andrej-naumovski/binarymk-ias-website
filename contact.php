<!DOCTYPE html>

<?php
	require 'scripts/connections.php';
	require 'scripts/hash.php';
?>

<html>
	<head>
		<title><?php echo $site_title . " - "; ?>Контактирај нè</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/register.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<script src="scripts/jquery-1.11.3.js"></script>
		<style>
			#message {
				width: 35em;
				height: 10em;
			}
		</style>
	</head>
	<body>
		<header>
		</header>
		<div id="main">
			<h1>КОНТАКТ ФОРМА</h1>
			<h3>ВНЕСЕТЕ ЈА ВАШАТА ПОРАКА</h3>
			<form method="post" action="#">
				<input type="text" class="input" name="firstName" placeholder="Име" required />
				<input type="text" class="input" name="lastName" placeholder="Презиме" required />
				<input type="email" class="input" id="email" name="email" placeholder="E-mail адреса" required />
				<textarea class="input" id="message" name="message" rows="7" maxlength="350" wrap="soft" cols="50" placeholder="Вашата порака тука" required></textarea>
				<input type="submit" id="submitBtn" name="submit" value ="ПРАТИ ПОРАКА" />
			</form>
			<?php
				if(isset($_POST['submit'])) {
					$to = 'a.naumovski996@yahoo.com';
					$from = $_POST['email'];
					$name = $_POST['firstName'] . ' ' . $_POST['lastName'];
					$subject = 'Binary.mk Contact Form: ' . $name . ' ' . $from;
					$message = $_POST['message'];
					$message = wordwrap($message, 70, '\r\n');
					$headers = 'From: ' . $from . '\r\n' .
								'Reply-To: ' . $from;
					mail($to, $subject, $message, $headers);
				}
				?>
		</div>
		<div id="undershade">
			<img src="images/register-undershade.png" />
		</div>
		<footer>
			<p id="copyright">COPYRIGHT &copy; BINARY.MK, 2015. РАЗВИЕНО ОД АНДРЕЈ НАУМОВСКИ И ЃОРЃИ МАРКОВ. СИТЕ ПРАВА СЕ ЗАДРЖАНИ</p>
			<p id="contact"><a href="#">КОНТАКТ</a></p>
			<img src="images/register-undershade.png" />
		</footer>
	</body>
</html>