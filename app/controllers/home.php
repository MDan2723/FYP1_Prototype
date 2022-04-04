<?php

require_once 'pub/lib/essentials.php';

class Home extends Controller
{
    
    public function index( $data='' ){
        $this->view('home/index', []);
    }
    public function notes( $data='' ){
        $this->view('home/notes', []);
    }
    public function exercises( $data='' ){
        $this->view('home/exercises', []);
    }

    public function settings( $data='' ){
        $this->view('home/settings', []);
    }

}