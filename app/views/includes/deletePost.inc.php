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
    $acc_id = $user->getData()['id'];
    $type = $_GET['type'];
    $id = $_GET['id'];

    switch($type){
        case 'thread':
            $qry = "DELETE FROM threads WHERE id = $id";
            break;
        case 'comment':
            $qry = "DELETE FROM comments WHERE id = $id";
            break;
    }

    if($DB->runQuery($qry)){
        // echo 'successful rating';
    }else{
        // echo 'unsuccessful rating';
    }
}
