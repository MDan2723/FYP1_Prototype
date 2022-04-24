<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }
require_once BASE_DIR."pub/lib/config.php";
require_once BASE_DIR."pub/lib/ess.debug.php";
require_once BASE_DIR."app/views/includes/ess.inc.php";
require_once BASE_DIR."app/models/Database.php";
require_once BASE_DIR."app/models/Account.php";


if( isset($_SESSION['user']) ){
    $DB = new Database();
    $user = unserialize($_SESSION['user']);
    $dataUser = $user->getData();

    if( password_verify($_GET['password'],$dataUser['password'] )){
        $qry = "DELETE FROM accounts WHERE id = ".$dataUser['id'];
        
        if($DB->runQuery($qry)){
            echo 'successful deletion';
            unset( $_SESSION['user'] );
        }else{
            echo 'unsuccessful deletion';
        }
        
    }
    else{
        echo "poopy password";
        // go_to("user?error=wrongPassword");
    }
    rtrn();
}