<?php

require_once 'pub/lib/essentials.php';

class Account extends Controller
{
    
    public function index( $data='' ){
        $this->view('account/index', []);
    }
    public function post( $data='' ){
        $this->view('account/login', []);
    }
    public function thread( $data='' ){
        $this->view('account/signup', []);
    }
}