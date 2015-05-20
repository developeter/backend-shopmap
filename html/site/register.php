<?php

	include=("/global.php");
	
	$username = $_POST('username');
	$password = $_POST('password');
	$email = $_POST('email');
	$error = "";
	
	if($_POST) {
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
	}
		
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrazione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Registrazione</title>
</head>
<body>
<div class="container">
<div class="jumbotron">
    <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>


            <div class="form-group">
                <label for="email" class="col-sm-2 col-lg-2 control-label">Email</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="text" class="form-control" id="email" placeholder="Inserisci l'indirizzo email...">
                </div>
            </div>

            <div class="form-group">
                <label for="nome" class="col-sm-2 col-lg-2 control-label">Username</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="text" class="form-control" id="nome" placeholder="Inserisci il nome...">
                </div>
            </div>


            <div class="form-group">
                <label for="password" class="col-sm-2 col-lg-2 control-label">Password</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="password" class="form-control" id="password" placeholder="Inserisci la password...">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-5 col-lg-5 col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Invia</button>
                </div>
            </div>

            </fieldset>
        </form>
        <div style="error"><?php echo $error; ?></div>
        </div>
        </div>

</body>
</html>
