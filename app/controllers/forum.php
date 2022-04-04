<?php

require_once 'pub/lib/essentials.php';

class Forum extends Controller
{
    
    public function index( $data='' ){
        $this->view('forum/index', []);
    }
    public function post( $data='' ){
        $this->view('forum/post', []);
    }
    public function thread( $data='' ){
        $this->view('forum/thread', []);
    }
}