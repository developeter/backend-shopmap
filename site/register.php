<?php

	require_once=("./global.php");
	
	$username = $_POST('username');
	$password = $_POST('password');
	$email = $_POST('email');
	$error = "";
	
		if($username != "" OR $password != ""){
			if($email != ""){
				$query="INSERT INTO login (username, password, email) VALUES ('".$username."', '".$password."', '".$email"');";
				// connetto al server
				$connection = mysqli_connect("localhost", $userdb, $dbpw);
				// pulisco input
				$username = stripslashes($username);
				$password = stripslashes($password);
				$email = stripslashes($email);
				$username = mysqli_real_escape_string($username);
				$password = mysqli_real_escape_string($password);
				//selezione db
				$db = mysqli_select_db("shopmap", $connection);
				//setto la query
				$result = mysqli_query($query);
				(if !$result){
					$error = "Errore connessione al database.";
				}else{
					$error = "Registrato.";
					$error.= "<a href='./profile.php'>Vai al profilo</a>";
				}
				mysqli_close($connection);
			}else{
				$error = "Il campo email non può essere vuoto!";
			}
		}else{
			$error = "I campi nome utente e password non possono essere vuoti!";
		}
		
?>
