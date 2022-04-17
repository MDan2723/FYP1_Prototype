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

    if($DB->hasRated($type,$acc_id,$id)){
        // echo 'has rated';
        switch($type){
            case 'thread':
                $qry = "DELETE FROM thread_ratings WHERE acc_id = $acc_id and thread_id = $id";
                break;
            case 'comment':
                $qry = "DELETE FROM comment_ratings WHERE acc_id = $acc_id and comment_id = $id";
                break;
        }
        
    }else{
        // echo ' has not';
        switch($type){
            case 'thread':
                $qry = "INSERT INTO thread_ratings ( acc_id, thread_id ) VALUES ( '$acc_id', '$id' )";
                break;
            case 'comment':
                $qry = "INSERT INTO comment_ratings ( acc_id, comment_id ) VALUES ( '$acc_id', '$id' )";
                break;
        }
    }

    if($DB->runQuery($qry)){
        // echo 'successful rating';
    }else{
        // echo 'unsuccessful rating';
    }
}
