<?php

require_once 'pub/lib/essentials.php';

class User extends Controller
{
    
    public function index( $data='' ){
        $this->view('user/index', []);
    }
    public function login( $data='' ){
        $this->view('user/login', []);
    }
    public function signup( $data='' ){
        $this->view('user/signup', []);
    }
    public function logout( $data='' ){
        $this->view('includes/logout.inc', 'user');
    }
}