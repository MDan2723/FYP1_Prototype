<?php

class Controller
{
    public function model( $model )
    {
        if( file_exists('app/models/'.$model.'.php') )
        {
            require_once 'app/models/'.$model.'.php';
            return new $model();
        }
        else
        {
            echo "WHERE YOUR MODEL AT, BRO?";
            die();
        }
    }

    public function view( $view, $data=[] )
    {
        // testData($view);
        $url = explode( '/', $view );
        // testDataHere($url);
        if( file_exists('app/views/'.$view.'.php') )
        {
            require_once 'pub/lib/essentials.php';
            
            // if( $url[0]=="home" ) require_once 'pub/lib/ess_cat_prd.php';
            // if( $url[0]=="admin" ) require_once 'pub/lib/ess.admin.php';
            
            // testDataHere($view);
            require_once "app/views/".$view.".php";
        }
        else
        {
            echo "WHERE YOUR VIEW AT, BRO?";
            die();
        }
    }


}