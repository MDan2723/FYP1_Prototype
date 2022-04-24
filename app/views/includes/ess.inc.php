<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }

function go_to($url){
	header("Location: ".$_SESSION['BASE_URL'].$url);
	exit();
}

function rtrn(){
	if( isset($_SESSION['from']) ){
		header("Location: ".$_SESSION['BASE_URL'].$_SESSION['from']);
		exit();
	}
	else{
		header("Location: ".$_SESSION['BASE_URL']);
		exit();
	}
}

?>