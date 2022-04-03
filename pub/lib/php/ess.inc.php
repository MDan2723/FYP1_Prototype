<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }

function go_to($url){
	header("Location: ".$_SESSION['BASE_URL'].$url);
	exit();
}

?>