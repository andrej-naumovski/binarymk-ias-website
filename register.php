<!DOCTYPE html>

<?php
	require 'scripts/connections.php';
	require 'scripts/hash.php';
?>

<html>
	<head>
		<title>Регистрирај се</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/register.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<script src="scripts/jquery-1.11.3.js"></script>
		<script src="scripts/equalitychecker.js"></script>
	</head>
	<body>
		<header>
		</header>
		<div id="main">
			<h1>ПРИДРУЖИ СЕ НА BINARY.MK</h1>
			<h3>ВЕЌЕ СИ РЕГИСТРИРАН? <a href="login.php">НАЈАВИ СЕ ТУКА</a></h3>
			<form method="post" action="#">
				<input type="text" class="input" name="firstName" placeholder="Име" required />
				<input type="text" class="input" name="lastName" placeholder="Презиме" required />
				<input type="email" class="input" id="email" name="email" placeholder="E-mail адреса" required />
				<p id="invalidEmail" class="error">Внесете валидна e-mail адреса</p>
				<input type="email" class="input" id="repeatEmail" name="repeatEmail" placeholder="Повтори e-mail адреса" required />
				<p id="invalidRepeatEmail" class="error">Внесете валидна e-mail адреса</p>
				<p id="emailsNotEqual" class="error">E-mail адресите не се исти!</p>
				<input type="text" class="input" id="username" name="username" placeholder="Корисничко име" required />
				<p id="shortUsername" class="error">Корисничкото име мора да има минимум 6 карактери</p>
				<p id="invalidCharacters" class="error">Корисничкото име може да содржи само букви, цифри и -, _ и .</p>
				<input type="password" class="input" id="password" name="password" placeholder="Лозинка" required />
				<p id="shortPassword" class="error">Лозинката мора да е подолга од 6 знаци</p>
				<input type="password" class="input" id="repeatPassword" name="repeatPassword" placeholder="Повтори лозинка" required />
				<p id="passwordsNotMatch" class="error">Лозинките не се исти!</p>
				<input type="submit" id="submitBtn" name="submit" value="РЕГИСТРИРАЈ СЕ" />
			</form>
			<?php
				if(isset($_POST['submit'])) {
					$first_name = $_POST['firstName'];
					$last_name = $_POST['lastName'];
					$email = $_POST['email'];
					$repeat_email = $_POST['repeatEmail'];
					$username = $_POST['username'];
					$password = $_POST['password'];
					$repeat_password = $_POST['repeatPassword'];
					$correct = true;
					if(!preg_match("/^[A-Z][a-zA-Z\-]*$/", $first_name) || !preg_match("/^[A-Z][a-zA-Z\- ]*$/", $last_name)) {
						printf("<p style=\"color: red;\">Please input a correct first and last name!</p>");
						$correct = false;
					}
					$sql = "select * from users where Email='$email'";
					if($mysqli->query($sql)->fetch_row()) {
						printf("<p style=\"color: red;\">A user with that e-mail already exists!</p>");
						$correct = false;
					}
					$sql = "select * from users where Username='$username'";
					if($mysqli->query($sql)->fetch_row()) {
						printf("<p style=\"color: red;\">A user with that username already exists!</p>");
						$correct = false;
					}
					if($correct) {
						$hashed_password = create_hash($password);
						$sql = "insert into users (FirstName,LastName,Email,Username,Password)
						Values('$first_name','$last_name','$email','$username','$hashed_password')";
						$mysqli->query($sql);
						printf("<p style=\"color: green; font-size: 15px;\">Registered sucessfully! <a href=\"login.php\">Click here</a> to login.</p>");
					}
				}
				?>
		</div>
		<div id="undershade">
			<img src="images/register-undershade.png" />
		</div>
		<footer>
			<p id="copyright">COPYRIGHT &copy; BINARY.MK, 2015. РАЗВИЕНО ОД АНДРЕЈ НАУМОВСКИ И ЃОРЃИ МАРКОВ. СИТЕ ПРАВА СЕ ЗАДРЖАНИ</p>
			<p id="contact"><a href="contact.php">КОНТАКТ</a></p>
			<img src="images/register-undershade.png" />
		</footer>
	</body>
</html>