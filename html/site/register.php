<?php

	include("./global.php");
	$error = "";
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['username'] != "" || $_POST['password'] != ""){
			if($_POST['email'] != ""){
				
				$username=htmlspecialchars($_POST['username']);
				$password=htmlspecialchars($_POST['password']);
				$email=htmlspecialchars($_POST['email']);
				
				$query="INSERT INTO login (username, password, email) VALUES ('" . $username . "', '" . $password . "', '" . $email . "');";
				// connetto al server
				$connection = mysqli_connect("127.0.0.1", $userdb, $dbpw);
				//selezione db
				mysqli_select_db($connection, $dbname) or die("Could not select database");
				//setto la query
				mysqli_query($connection, $query) or die(mysqli_error($connection));
				$error = 'Registrato.&nbsp;<a href="profile.php">Vai al profilo</a>';
				mysqli_close($connection);
			}else{
				$error .= "Il campo email non può essere vuoto! <br>";
			}
		}else{
			$error .= "I campi nome utente e password non possono essere vuoti! <br>";
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
    <form class="form-horizontal" action="" method="POST">
        <fieldset>

            <div class="form-group">
                <label for="email" class="col-sm-2 col-lg-2 control-label">Email</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Inserisci l'indirizzo email">
                </div>
            </div>

            <div class="form-group">
                <label for="nome" class="col-sm-2 col-lg-2 control-label">Nome utente</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="text" class="form-control" id="nome" name="username" placeholder="Inserisci il nome utente">
                </div>
            </div>


            <div class="form-group">
                <label for="password" class="col-sm-2 col-lg-2 control-label">Password</label>
                <div class="col-sm-5 col-lg-5">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-5 col-lg-5 col-sm-offset-2">
                    <button type="submit" id="submit" class="btn btn-default">Invia registrazione</button>
                </div>
            </div>

            </fieldset>
        </form>
        <div style="error"><?php echo $error; ?></div>
        </div>
        </div>

</body>
</html>
