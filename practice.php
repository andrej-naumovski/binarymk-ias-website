<!DOCTYPE html>

<?php require 'scripts/connections.php'; ?>

<?php 
	define("USERNAME_INDEX", 4);
	session_start();
	if(!isset($_SESSION['UserID'])) {
		header("Location: login.php");
	}
?>

<html>
	<head>
		<title><?php echo $site_title . " - "; ?>Вежби и задачи</title>
		<meta charset="utf-8" />
		<link href="styles/clear.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<link href="styles/practice.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico?<?php echo time() ?>" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
		<script src="/scripts/jquery-1.11.3.js"></script>
		<script src="/scripts/menubuttons.js"></script>
		<script src="/scripts/loadexercises.js"></script>
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
			<div id="hide">
				<a href="#">
					<div class="contentBtn" id="easy">
						<h3>ЛЕСНО НИВО</h3>
					</div>
				</a>
				<div class="content" id="easyContent">
					<p>Да се напише рекурзивна функција која за даден број ќе пресмета од колку цифри е составен.</p>
					<hr />
					<p>Од тастатура се читаат N цели броеви (N се внесува од тастатура). Да се напише
						програма <br /> која на екран ќе испечати дали внесените броеви формираат строго растечка низа <br/>
						(односно секој елемент да е помал од неговиот следбеник). </p>
						<hr />
					<p>Да се напише програма која ќе собира 2 матрици, а резултатот ќе го смести во нова
						матрица. <br/> Потоа, да се напише функција која од новодобиената матрица ќе ја испечти само <br/>
						горно-тиаголната матрица.</p>
				</div>
				<a href="#">
					<div class="contentBtn" id="medium">
						<h3>СРЕДНО НИВО</h3>
					</div>
				</a>
				<div class="content" id="mediumContent">
					<p>Од тастатура се внесуваат непознат број на цели броеви. Да се провери дали бројот <br/>
						формиран од цифрата на стотки и цифрата на десетки е прост. Формирањето на новиот <br/>
						број, како и проверката дали истиот е прост да се реализира со посебни функции. На крај
						да се  <br/>испечати колку од внесените броеви го исполнуваат условот. На пример:<br/>
						Внесен е бројот: 2174 => Бројот 17 е прост број<br/>
						Внесен е бројот: 16557 => Бројот 55 не е прост број</p>
					<hr />
					<p>Да се напише функција која како аргумент добива цел број. Како резултат <br/ >
						функцијата враќа дали цифрите на бројот се во неопаѓачки редослед од десно кон лево.</p>
					<hr />
					<p>Да се напише функција која дадена низа ќе ја промени така што сите елементи ќе ги премести <br/>
						во лево за n места (n се внесува од тастатура) така што најлевите елементи ќе се додадат на <br/>
						крајот од новодобиената низа. Потоа, да се напише главна програма која ќе ја испроба <br/>
						работата на оваа функција. Главната програма треба да дозволи внесување на низа од <br/>
						целобројни елементи (не повеќе п=од 100) и притоа ќе ја испечати променетата низа на екран.</p>
				</div>
				<a href="#">
					<div class="contentBtn" id="hard">
						<h3>ТЕШКО НИВО</h3>
					</div>
				</a>
				<div class="content" id="hardContent">
					<p>Да се напише рекурзивна функција која ке најде разлика од ASCII
						кодовите на цифрите на даден број. <br/>
						Забелешка: ‘4’-‘0’=4 ; ‘8’-‘0’=8</p>
					<hr />
					<p>Двајца играчи играат табланет се додека некој од нив не добие 3 партии. Една партија е добиена <br/>	
					доколку некој од нив освои повеќе од половина од вкупните поени. Од еден шпил карти (52 карти),  <br/>
					се бројат вкупно 22 карти и на тоа се додаваат уште 3 карти за играчот кој освоил поголем вкупен <br/>
					 број на карти во тековната партија. За првиот играч внесувате информација колку вкупно карти освоил <br/>
					 во една партија и колку од нив се бројат (доколку внесете невалидна информација внесувате пак), <br/>
					 а за вториот играч само го пресметувате бројот на вкупни и преброиви карти (она што останало според <br/>
					 дадените информации погоре). Во зависност од добиените информации за двајцата играчи го одредувате  <br/>
					 победникот во тековната парија и откако ќе го добиете вкупниот победник (првиот кој добил 3 партии) <br/>
					 ја прекинувате играта и го печатите неговото име. </p>
					<hr />
					<p>Да се напише функција која како аргумент добива низа од цели броеви и должина на низата. Функцијата <br/>
					 треба да го врати најголемиот елемент на низата и да ја промени низата така што најголемиот елемент <br/>
					 ќе го отфрли од низата. Доколу има повеќе елементи со иста „најголема“ вредност, функцијата треба <br/>
					 да го пронајде и отфрли првиот таков најден елемент. Потоа, да се напише главна програма која <br/>
					 треба да изврши рангирање на натпревар во брзо лизгање со користење на оваа функција. Од тастатура <br/>
					  се внесуваат шифрите (цели броеви) и времињата на пристигнување (цели броеви) на лизгачите. <br/>
					  Програмата треба на екран да ги прикаже шифрите и времињата на првите и последните 5 лизгачи. <br/>
					  Листата треба да има најмалку 10 лизгачи, но не повеќе од 200 лизгачи.</p>
				</div>
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
