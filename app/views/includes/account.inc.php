<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }
require_once BASE_DIR."pub/lib/config.php";
require_once BASE_DIR."pub/lib/ess.debug.php";
require_once BASE_DIR."app/views/includes/ess.inc.php";
require_once BASE_DIR."app/models/Database.php";
require_once BASE_DIR."app/models/Account.php";

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

$ACC = new Account('');

if(isset($_POST['submit'])){
	
//	testData($_POST);
	
	switch( strtolower($_POST['submit']) ){
		case "login": $ACC->login_acc();
		break;
		case "signup": $ACC->signup_acc();
		break;
		case "edit": $ACC->edit_acc();
		break;
		case "delete": $ACC->delete_acc();
		break;
		default: echo "no input made";
		
	}
	
}else{
	echo "no input made : ".$_POST['submit'];
}

//rtrn();