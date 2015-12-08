<!DOCTYPE html>

<?php
	require 'scripts/connections.php';
	require 'scripts/hash.php';
?>

<?php
	session_start();
	if(isset($_SESSION['UserID'])) {
		header('Location: index.php');
	}
?>

<html>
<head>
    <title>Login</title>
	<meta charset="utf-8" />
    <link href="styles/clear.css" rel="stylesheet" type="text/css" />
    <link href="styles/login.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script src="/scripts/jquery-1.11.3"></script>
    <!--resetting CSS used in transitions because of stupid Chrome-->
    <style>
        .submitBtn {
            color: #eee;
            font-size: 41px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 1);
        }
        #register {
            font-size: 21px;
        }
        footer a {
            font-size: 15px;
         }
    </style>
</head>
<body>
    <header>
    </header>
    <div id="main">
        <h1>ДОБРЕДОЈДОВТЕ</h1>
        <img src="images/login_divisor.png" style="padding:0px; margin:0px;" />
        <h3>ВЕ МОЛИМЕ НАЈАВЕТЕ СЕ</h3>
        <div id="login">
            <form action="" method="post">
                <input type="text" class="input" name="username" placeholder="Корисничко име или e-mail" required/>
                <input type="password" class="input" name="password" placeholder="Лозинка" required />
                <?php
                	define("PASSWORD_INDEX", 5);
                	define("USERID_INDEX", 0);

            		if(isset($_POST['submit'])) {
            			$username=$_POST['username'];
            			$password=$_POST['password'];
            			if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            				$sql = "select * from users where Email='$username'";
            			} else {
            				$sql = "select * from users where Username='$username'";
            			}
            			$result = $mysqli->query($sql);
            			if(!$result) {
            				echo "<p style=\"color:red\">Invalid login</p>";
            			} else {
            				$row = $result->fetch_row();
            				$hashed_password = $row[PASSWORD_INDEX];
            				if(checkPassword($password, $hashed_password)) {
            					session_start();
            					$_SESSION['UserID'] = $row[USERID_INDEX];
            					header('Location: index.php');
            				} else {
            					echo "<p style=\"color:red\">Invalid login</p>";
            				}
            			}
            		}

            	?>
                <input id="submitBtn" type="submit" name="submit" value="НАЈАВИ СЕ" />
            </form>
            
        </div>
        <img src="images/login_undershadow.png" style="margin-bottom: 0px;" />
        <p id="notAMember">НЕ СИ ЧЛЕН? <span id="divisor">|</span> <a href="register.php"><span id="register">РЕГИСТРИРАЈ СЕ</span></a></p>
        <img src="images/login_undershadow.png" />
    </div>
    <footer>
        <p id="forgotPwd"><a href="#">СИ ЈА ЗАБОРАВИВТЕ ЛОЗИНКАТА?</a></p>
        <p id="contact"><a href="#">КОНТАКТ</a></p>
        <img src="images/login_undershadow.png" />
    </footer>
</body>
</html>
