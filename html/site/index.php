<?php

session_start();
	if(!isset($_SESSION['login_user']) && empty($_SESSION['login_user']) && !isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
		header('Location: login.php');
	}else {
		header('Location: profile.php');
	};
	
?>
