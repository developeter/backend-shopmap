<?php
	session_start();
	unset($_SESSION["login_user"]);
	unset($_SESSION["user_ID"]);
	session_destroy();
	header("Location: login.html");
?>
