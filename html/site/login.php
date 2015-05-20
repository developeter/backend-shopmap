<?php
	include("./global.php");
	session_start();
	$error="";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (empty($_POST['username']) || empty($_POST['password'])) {
	$error = "Nome utente o password non validi.";
	}else{
		$username=$_POST['username'];
		$password=$_POST['password'];
		// pulisco input
		$username = htmlspecialchars($username);
		$password = htmlspecialchars($password);
		// connetto al server
		$connection = mysqli_connect("127.0.0.1", $userdb, $dbpw) or die(mysqli_error());
		mysqli_select_db($connection, $dbname) or die('Could not select database.');
		//cerco gli utenti
		$query = "SELECT ID, username, password FROM login WHERE username='" . $username . "' AND password='" . $password . "';";
		$result = mysqli_query($connection, $query);
		$userid = mysqli_fetch_row($result);
		if ($userid) {
			$_SESSION['login_user']=$username;
			$_SESSION['user_ID']=$userid[0]; // memorizzo roba in sessione
			header("location: profile.php"); // vado al profilo
		} else {
			$error = "Nome utente o password errati.";
		}
		mysqli_close($connection);
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>ShopMap | Gestione utenti | Login</title>
</head>
<body>

<div class="container login">

    <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">ShopMap | Gestione utenti</h2>
        <h5>Inserisci i tuoi dati di identificazione</h5><br>
        <input type="text" id="username" name="username" class="form-control" placeholder="Nome utente" required autofocus><br>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit">Login</button>
    </form>
    <a href="register.php" class="btn btn-lg btn-primary btn-block" id="register">Registrazione</a>
    <div class="error"><?php echo $error; ?></div>

</div>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
