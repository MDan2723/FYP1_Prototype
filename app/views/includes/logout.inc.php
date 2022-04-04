<?php
	if( isset($_SESSION[$data]) ){
		unset($_SESSION[$data]);
	}

	// if (session_status() === PHP_SESSION_NONE){ session_start(); }
	// session_unset();
	// session_destroy();

	header("Location: ".$_SESSION['BASE_URL']);
	exit();
