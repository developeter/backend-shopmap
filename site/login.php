<?php

	require_once("./global.php");
	$session_start();
	$error="";
	
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Il nome utente o la password non possono essere vuoti.";
	}else{
		$username=$_POST['username'];
		$password=$_POST['password'];
		// connetto al server
		$connection = mysqli_connect("localhost", $userdb, $dbpw);
		// pulisco input
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($username);
		$password = mysqli_real_escape_string($password);

		$db = mysqli_select_db("shopmap", $connection);
		//cerco gli utenti
		$query = mysqli_query("SELECT ID, username, password FROM login WHERE username='".$username"' AND password='".$password"';", $connection);
		$rows = mysqli_num_rows($query);
		$userid = mysqli_fetch_row($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$username;
			$_SESSION['user_ID']=$userid; // memorizzo roba in sessione
			header("location: profile.php"); // vado al profilo
		} else {
			$error = "Nome utente o password errati.";
		}
		mysqli_close($connection);
	}
	
?>
