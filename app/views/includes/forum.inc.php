<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }
require_once BASE_DIR."pub/lib/config.php";
require_once BASE_DIR."pub/lib/ess.debug.php";
require_once BASE_DIR."app/views/includes/ess.inc.php";
require_once BASE_DIR."app/models/Database.php";

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

if(isset($_POST['submit'])){
	$DB = new Database();
//	testData($_POST);
	
	switch( strtolower($_POST['submit']) ){
		case "post thread": $DB->makeThread();
		    break;
		case "post comment": $DB->makeComment();
		    break;
		default: echo "no input made";
            break;
	}
	
}else{
	echo "no input made : ".$_POST['submit'];
}

//rtrn();