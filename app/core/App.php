<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->parseURL();
        // testData($url);
        if($url!=null)
        {
            if( file_exists('app/controllers/'.$url[0].'.php') )
            {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
        require_once 'app/controllers/'.$this->controller.'.php';

        // testData($this->controller);
        $this->controller[0] = strtoupper($this->controller[0]);
        $this->controller = new $this->controller; 
        
        $url = $url ? array_values($url) : []; // testData($this->params);
        // testData($url);
        if( isset( $url[0] ) )
        {
            if( method_exists($this->controller, $url[0]) )
            {
                $this->method = $url[0];
                unset($url[0]);
            }
        }
        // testDataHere($url);
        
        $this->params = $url ? array_values($url) : []; // testData($this->params);

        call_user_func_array( [$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if( isset($_GET['url']) ){
            return $url = explode( '/', filter_var( rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL) ); // echo $_GET['url'];
        }
    }
}